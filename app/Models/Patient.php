<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'date_of_birth',
        'gender',
        'contact',
        'address',
        'condition',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

       public function getFullNameAttribute(): string
    {
        $first = $this->first_name ?? 'Unknown';
        $last  = $this->last_name  ?? 'Walk-in';
        return trim("{$first} {$last}");
    }

   
    public function getInitialsAttribute(): string
    {
        return strtoupper(
            substr($this->first_name ?? 'U', 0, 1) .
            substr($this->last_name  ?? 'K', 0, 1)
        );
    }

    
    public function queues()
    {
        return $this->hasMany(Queue::class);
    }

   
    public function activeQueue()
    {
        return $this->hasOne(Queue::class)
            ->whereIn('status', ['waiting', 'called', 'serving'])
            ->latest();
    }
}