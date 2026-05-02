<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Queue;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalPatients  = Patient::count();
        $totalUsers     = User::count();
        $servedToday    = Queue::where('status', 'done')
                               ->whereDate('updated_at', today())
                               ->count();
        $patientsToday  = Patient::whereDate('created_at', today())->count();

        $recentUsers = User::latest()->take(8)->get();
       
        $recentPatients = Patient::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalPatients', 
            'totalUsers', 
            'servedToday',
            'patientsToday', 
            'recentPatients', 
            'recentUsers',  
        ));
    }

    public function patients()
    {
        $patients = Patient::latest()->paginate(15);
        return view('admin.patients.index', compact('patients'));
    }

    public function showPatient(Patient $patient)
    {
        $queues = Queue::with('doctor')
                       ->where('patient_id', $patient->id)
                       ->latest()
                       ->get();
        return view('admin.patients.show', compact('patient', 'queues'));
    }
}