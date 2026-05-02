<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'age'           => 'required|integer|min:0|max:150',
            'gender'        => 'required|in:Male,Female,Other',
            'contact'       => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'condition'     => 'required|string|max:500',
            'priority'      => 'required|in:critical,urgent,normal',
        ]);

       
        $patient = Patient::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'date_of_birth' => $data['date_of_birth'],
            'age'           => $data['age'],
            'gender'        => $data['gender'],
            'contact'       => $data['contact'] ?? null,
            'address'       => $data['address'] ?? null,
            'condition'     => $data['condition'],
        ]);

        
        $prefix = match($data['priority']) {
            'critical' => 'E',
            'urgent'   => 'P',
            default    => 'R',
        };
        $lastNum = Queue::where('queue_number', 'like', $prefix . '%')
            ->whereDate('created_at', today())
            ->count() + 1;
        $queueNumber = $prefix . str_pad($lastNum, 2, '0', STR_PAD_LEFT);

        
        Queue::create([
            'patient_id'   => $patient->id,
            'doctor_id'    => null,
            'queue_number' => $queueNumber,
            'priority'     => $data['priority'],
            'status'       => 'waiting',
            'called_at'    => null,
        ]);

        return redirect()->route('dashboard')
            ->with('success', "Patient {$patient->first_name} {$patient->last_name} registered as {$queueNumber}.");
    }
}



