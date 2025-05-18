<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeActivity extends Model
{
    protected $fillable = [
        'event_day_id', 
        'time', 
        'activity',
    ];

    public function event_days() {
         return $this->belongsTo(EventDay::class, 'event_day_id', 'id'); 
    }
}
