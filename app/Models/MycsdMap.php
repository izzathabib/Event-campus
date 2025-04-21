<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MycsdMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'taj_prog',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
