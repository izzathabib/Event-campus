<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaperWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tajuk_kk',
        'peng_kump_sasar',
        'obj',
        'impak',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
