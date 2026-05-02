<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'queue_number',
        'priority',
        'status',
        'called_at',
        'notes',
    ];

    protected $casts = [
        'called_at' => 'datetime',
    ];

   

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

  

    public function getWaitMinutesAttribute(): int
    {
        if ($this->status === 'completed') return 0;

        return $this->created_at
            ? now()->diffInMinutes($this->created_at)
            : 0;
    }

    public function getWaitLabelAttribute(): string
    {
        $mins = $this->wait_minutes;

        if ($mins < 60) return "{$mins}m";

        $h = intdiv($mins, 60);
        $m = $mins % 60;

        return $m > 0 ? "{$h}h {$m}m" : "{$h}h";
    }


    public function scopeWaiting($query)
    {
        return $query->where('status', 'waiting');
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['waiting', 'serving']);
    }

    public function scopeCritical($query)
    {
        return $query->where('priority', 'critical');
    }

    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }

    public function scopeNormal($query)
    {
        return $query->where('priority', 'normal');
    }

    public function scopeTriageOrder($query)
    {
        return $query->orderByRaw("FIELD(priority, 'critical', 'urgent', 'normal')")
                     ->orderBy('created_at');
    }
}