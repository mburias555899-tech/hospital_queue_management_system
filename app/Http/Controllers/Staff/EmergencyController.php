<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmergencyController extends Controller
{
    public function create()
    {
        return view('staff.emergency.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'age'        => ['nullable', 'string', 'max:10'],
            'gender'     => ['required', 'in:Male,Female,Other,Unknown'],
            'condition'  => ['required', 'string', 'max:500'],
            'contact'    => ['nullable', 'string', 'max:20'],
        ]);

        DB::transaction(function () use ($validated, &$queue) {
            $patient = Patient::create([
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'age'        => $validated['age'] ?? 'Unknown',
                'gender'     => $validated['gender'],
                'condition'  => $validated['condition'],
                'contact'    => $validated['contact'] ?? null,
            ]);

           
            $dailyCount  = Queue::whereDate('created_at', today())
                                ->where('priority', 'critical')
                                ->count();

            $queueNumber = 'C-' . str_pad($dailyCount + 1, 3, '0', STR_PAD_LEFT);

            $queue = Queue::create([
                'patient_id'   => $patient->id,
                'queue_number' => $queueNumber,
                'priority'     => 'critical',
                'status'       => 'waiting',
            ]);
        });

        return redirect()
            ->route('staff.queue.emergency')
            ->with('success', "Emergency patient registered and placed at the top of the queue.");
    }
}