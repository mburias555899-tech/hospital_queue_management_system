<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Http\Request;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $assignedQueues = Queue::with('patient')
            ->where('doctor_id', auth()->id())
            ->orderByRaw("FIELD(status, 'serving', 'called', 'waiting', 'done')")
            ->orderByRaw("FIELD(priority, 'critical', 'urgent', 'normal')")
            ->orderBy('created_at')
            ->get();

        $servedToday = Queue::where('doctor_id', auth()->id())
            ->where('status', 'done')
            ->whereDate('updated_at', today())
            ->count();

        return view('doctor.dashboard', compact('assignedQueues', 'servedToday'));
    }

       public function patient(Queue $queue)
    {
        abort_if($queue->doctor_id !== auth()->id(), 403);

        $patient = $queue->patient;

        $history = Queue::where('patient_id', $patient->id)
            ->orderByDesc('created_at')
            ->get();

        return view('doctor.patient', compact('queue', 'patient', 'history'));
    }
    public function done(Queue $queue)
    {
        abort_if($queue->doctor_id !== auth()->id(), 403);

        $queue->update(['status' => 'done']);

        return redirect()->route('doctor.dashboard')
            ->with('success', "Patient #{$queue->queue_number} marked as done.");
    }

   
    public function notes(Request $request, Queue $queue)
    {
        abort_if($queue->doctor_id !== auth()->id(), 403);

        $request->validate([
            'notes' => 'nullable|string|max:2000',
        ]);

        $queue->update(['notes' => $request->notes]);

        return back()->with('success', 'Consultation notes saved.');
    }
}