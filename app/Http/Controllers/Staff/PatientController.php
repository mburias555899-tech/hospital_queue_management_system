<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function create()
    {
        return view('staff.patients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => ['required', 'string', 'max:100'],
            'last_name'     => ['required', 'string', 'max:100'],
            'age'           => ['required', 'string', 'max:10'],
            'date_of_birth' => ['nullable', 'date'],
            'gender'        => ['required', 'in:Male,Female,Other'],
            'contact'       => ['nullable', 'string', 'max:20'],
            'address'       => ['nullable', 'string', 'max:500'],
            'condition'     => ['nullable', 'string', 'max:500'],
            'priority'      => ['required', 'in:critical,urgent,normal'],
        ]);

        DB::transaction(function () use ($validated, &$queue) {
           
            $patient = Patient::create(
                collect($validated)->except('priority')->toArray()
            );

           
            $prefix = match($validated['priority']) {
                'critical' => 'C',
                'urgent'   => 'U',
                default    => 'N',
            };

            $dailyCount = Queue::whereDate('created_at', today())
                               ->where('priority', $validated['priority'])
                               ->count();

            $queueNumber = $prefix . '-' . str_pad($dailyCount + 1, 3, '0', STR_PAD_LEFT);

            
            $queue = Queue::create([
                'patient_id'   => $patient->id,
                'queue_number' => $queueNumber,
                'priority'     => $validated['priority'],
                'status'       => 'waiting',
            ]);
        });

        $priorityLabel = match($validated['priority']) {
            'critical' => '🔴 Critical — moved to top of queue.',
            'urgent'   => '🟠 Urgent — priority queued.',
            default    => '🟢 Normal — added to queue.',
        };

        return redirect()
            ->route('staff.dashboard')
            ->with('success', "Patient registered successfully. {$priorityLabel}");
    }
}