<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function index()
    {
      
        $today = now()->toDateString();

      
        $totalPatients = Patient::count();

        
        $patientsToday = Patient::whereDate('created_at', $today)->count();

        
        $waitingCount   = Queue::whereDate('created_at', $today)
                               ->where('status', 'waiting')->count();

        $servedToday    = Queue::whereDate('created_at', $today)
                               ->where('status', 'done')->count();

        $emergencyCount = Queue::whereDate('created_at', $today)
                               ->where('priority', 'emergency')->count();

       
        $recentPatients = Patient::latest()->take(10)->get();

        return view('staff.dashboard', compact(
            'totalPatients',
            'patientsToday',
            'waitingCount',
            'servedToday',
            'emergencyCount',
            'recentPatients',
        ));
    }
}