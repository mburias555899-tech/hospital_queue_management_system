<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    
    public function manage()
    {
        $queues = Queue::with(['patient', 'doctor'])
            ->whereIn('status', ['waiting', 'called', 'serving'])
            ->orderByRaw("FIELD(priority, 'critical', 'urgent', 'normal')")
            ->orderBy('created_at')
            ->paginate(25);

        $doctors = User::where('role', 'doctor')->get();

        $stats = [
            'waiting' => Queue::where('status', 'waiting')->count(),
            'called'  => Queue::where('status', 'called')->count(),
            'serving' => Queue::where('status', 'serving')->count(),
            'done'    => Queue::where('status', 'done')->whereDate('updated_at', today())->count(),
        ];

        return view('queue.manage', compact('queues', 'doctors', 'stats'));
    }

   
    public function emergency()
    {
        $queues = Queue::with(['patient', 'doctor'])
            ->where('priority', 'critical')
            ->orderByRaw("FIELD(status, 'waiting', 'called', 'serving', 'done')")
            ->orderBy('created_at')
            ->paginate(20);

        $doctors = User::where('role', 'doctor')->get();

        return view('queue.emergency', compact('queues', 'doctors'));
    }

   
    public function priority()
    {
        $queues = Queue::with(['patient', 'doctor'])
            ->where('priority', 'urgent')
            ->orderByRaw("FIELD(status, 'waiting', 'called', 'serving', 'done')")
            ->orderBy('created_at')
            ->paginate(20);

        $doctors = User::where('role', 'doctor')->get();

        return view('queue.priority', compact('queues', 'doctors'));
    }

   
    public function regular()
    {
        $queues = Queue::with(['patient', 'doctor'])
            ->where('priority', 'normal')
            ->orderByRaw("FIELD(status, 'waiting', 'called', 'serving', 'done')")
            ->orderBy('created_at')
            ->paginate(20);

        $doctors = User::where('role', 'doctor')->get();

        return view('queue.regular', compact('queues', 'doctors'));
    }

    
    public function call(Queue $queue)
    {
        $queue->update([
            'status'    => 'called',
            'called_at' => now(),
        ]);

        return back()->with('success', "Patient #{$queue->queue_number} has been called.");
    }

    
    public function serve(Queue $queue)
    {
        $queue->update(['status' => 'serving']);

        return back()->with('success', "Patient #{$queue->queue_number} is now being served.");
    }

    public function done(Queue $queue)
    {
        $queue->update(['status' => 'done']);

        return back()->with('success', "Patient #{$queue->queue_number} consultation complete.");
    }
   
    public function assign(Request $request, Queue $queue)
    {
        $request->validate([
            'doctor_id' => 'nullable|exists:users,id',
        ]);

        $queue->update(['doctor_id' => $request->doctor_id ?: null]);

        return back()->with('success', 'Doctor assignment updated.');
    }


    public function updatePriority(Request $request, Queue $queue)
    {
        $request->validate([
            'priority' => 'required|in:critical,urgent,normal',
        ]);

        $queue->update(['priority' => $request->priority]);

        return back()->with('success', "Patient #{$queue->queue_number} moved to {$request->priority} queue.");
    }
}