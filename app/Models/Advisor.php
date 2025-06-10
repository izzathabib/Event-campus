<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $fillable = [
        'user_id', //society_id from users table
        'society_advisor_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function society_advisor_data()
    {
        return $this->belongsTo(User::class, 'society_advisor_id', 'id');
    }
}
