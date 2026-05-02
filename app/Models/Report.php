<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function scopePriorityOrder($query)
    {
        return $query->orderByRaw("
        CASE(
            WHEN priority = 'critical' THEN 1
            WHEN priority = 'urgent' THEN 2
            ELSE 3)
        END
        ")->orderBy('created_at');
        
    }
}
