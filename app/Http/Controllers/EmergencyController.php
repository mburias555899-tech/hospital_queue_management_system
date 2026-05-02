<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function create()
    {
        return view('emergency.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'age'        => 'nullable|integer|min:0|max:150',
            'gender'     => 'nullable|string|max:20',
            'contact'    => 'nullable|string|max:20',
            'address'    => 'nullable|string|max:255',
            'condition'  => 'required|string|max:1000',
            'symptoms'   => 'nullable|array',
            'is_unknown' => 'nullable',
        ]);

        $isUnknown = $request->boolean('is_unknown');

       
        $symptoms      = $request->input('symptoms', []);
        $conditionText = implode(', ', $symptoms);
        if (!empty($data['condition'])) {
            $conditionText .= ($conditionText ? ' — ' : '') . $data['condition'];
        }

        
        $patient = Patient::create([
            'first_name'    => $isUnknown ? 'Unknown'  : ($data['first_name'] ?? 'Unknown'),
            'last_name'     => $isUnknown ? 'Walk-in'  : ($data['last_name']  ?? 'Walk-in'),
            'date_of_birth' => null,
            'age'           => $data['age']     ?? null,
            'gender'        => $data['gender']  ?? null,
            'contact'       => $data['contact'] ?? null,
            'address'       => $data['address'] ?? null,
            'condition'     => $conditionText,
        ]);

        
        $lastNum = Queue::where('queue_number', 'like', 'E%')
            ->whereDate('created_at', today())
            ->count() + 1;
        $queueNumber = 'E' . str_pad($lastNum, 2, '0', STR_PAD_LEFT);

        
        Queue::create([
            'patient_id'   => $patient->id,
            'doctor_id'    => null,
            'queue_number' => $queueNumber,
            'priority'     => 'critical',
            'status'       => 'waiting',
            'called_at'    => null,
        ]);

        return redirect()->route('queue.emergency')
            ->with('success', "Emergency patient registered as {$queueNumber} — placed at top of queue.");
    }
}