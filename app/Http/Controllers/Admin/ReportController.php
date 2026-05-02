<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date ?? today()->toDateString();

        $total    = Queue::whereDate('created_at', $date)->count();
        $critical = Queue::where('priority', 'critical')->whereDate('created_at', $date)->count();
        $urgent   = Queue::where('priority', 'urgent')->whereDate('created_at', $date)->count();
        $normal   = Queue::where('priority', 'normal')->whereDate('created_at', $date)->count();
        $done     = Queue::where('status', 'done')->whereDate('created_at', $date)->count();
        $waiting  = Queue::where('status', 'waiting')->whereDate('created_at', $date)->count();
        $serving  = Queue::where('status', 'serving')->whereDate('created_at', $date)->count();

        $patientsToday      = Patient::whereDate('created_at', $date)->count();
        $totalPatients      = Patient::count();
        $totalUsers         = User::count();
        $totalDoctors       = User::where('role', 'doctor')->count();
        $totalNurses        = User::where('role', 'nurse')->count();
        $totalReceptionists = User::where('role', 'receptionist')->count();
        $totalAdmins        = User::where('role', 'admin')->count();

        $queues = Queue::with(['patient', 'doctor'])
            ->whereDate('created_at', $date)
            ->orderByRaw("FIELD(priority, 'critical', 'urgent', 'normal')")
            ->orderBy('created_at')
            ->get();

        return view('admin.reports.index', compact(
            'date', 'total', 'critical', 'urgent', 'normal',
            'done', 'waiting', 'serving',
            'patientsToday', 'totalPatients',
            'totalUsers', 'totalDoctors', 'totalNurses',
            'totalReceptionists', 'totalAdmins',
            'queues'
        ));
    }

    public function export(Request $request)
    {
        $date   = $request->date ?? today()->toDateString();
        $queues = Queue::with(['patient', 'doctor'])
            ->whereDate('created_at', $date)
            ->orderByRaw("FIELD(priority, 'critical', 'urgent', 'normal')")
            ->get();

        $filename = 'report-' . $date . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($queues, $date) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['MedSyst Queue Report — ' . $date]);
            fputcsv($handle, []);
            fputcsv($handle, ['Queue #', 'Patient', 'Age', 'Gender', 'Priority', 'Status', 'Doctor', 'Registered']);
            foreach ($queues as $q) {
                fputcsv($handle, [
                    $q->queue_number,
                    ($q->patient->first_name ?? '') . ' ' . ($q->patient->last_name ?? ''),
                    $q->patient->age ?? '—',
                    $q->patient->gender ?? '—',
                    ucfirst($q->priority),
                    ucfirst($q->status),
                    $q->doctor->name ?? 'Unassigned',
                    $q->created_at->format('Y-m-d H:i'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

   
    public function userStats()
    {
        $totalUsers         = User::count();
        $totalAdmins        = User::where('role', 'admin')->count();
        $totalDoctors       = User::where('role', 'doctor')->count();
        $totalNurses        = User::where('role', 'nurse')->count();
        $totalReceptionists = User::where('role', 'receptionist')->count();

        return view('admin.reports.user-stats-print', compact(
            'totalUsers', 'totalAdmins', 'totalDoctors',
            'totalNurses', 'totalReceptionists'
        ));
    }
}