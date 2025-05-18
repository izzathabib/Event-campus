<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventDay extends Model
{
        protected $fillable = [
            'paper_work_id', 
            'title', 
            'day_number',
        ];

        public function time_activities() {
             return $this->hasMany(TimeActivity::class); 
        }

        public function paper_works()
        {
            return $this->belongsTo(PaperWork::class, 'paper_work_id', 'id');
        }

}
