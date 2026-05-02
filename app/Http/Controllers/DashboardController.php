<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Queue;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        
        $emergencyCount = Queue::critical()->active()->count();
        $priorityCount  = Queue::urgent()->active()->count();
        $regularCount   = Queue::normal()->active()->count();
        $servedToday    = Queue::where('status', 'done')
                               ->whereDate('updated_at', today())
                               ->count();

       
        $waitingQueues = Queue::active()->get();
        $avgWait = $waitingQueues->isNotEmpty()
            ? round($waitingQueues->avg(fn($q) => now()->diffInMinutes($q->created_at)))
            : 0;

       
        $emergencyPatients = Queue::with('patient')
            ->critical()
            ->active()
            ->orderBy('created_at')
            ->take(3)
            ->get();

        $priorityPatients = Queue::with('patient')
            ->urgent()
            ->active()
            ->orderBy('created_at')
            ->take(3)
            ->get();

        $regularPatients = Queue::with('patient')
            ->normal()
            ->active()
            ->orderBy('created_at')
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'emergencyCount',
            'priorityCount',
            'regularCount',
            'servedToday',
            'avgWait',
            'emergencyPatients',
            'priorityPatients',
            'regularPatients',
        ));
    }
}