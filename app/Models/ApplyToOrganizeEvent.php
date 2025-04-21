<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyToOrganizeEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
