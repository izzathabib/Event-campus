<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MycsdMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paper_work_id',
        'kaedah',
        'hfp',
        'poster',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function paper_works()
    {
        return $this->belongsTo(PaperWork::class, 'paper_work_id', 'id');
    }
    
}
