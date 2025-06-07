<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Belanjawan extends Model
{
    protected $table = 'belanjawans';
    protected $fillable = [
        'paper_work_id',
        'pendapatan',
        'unit_pendapatan',
        'rm_pendapatan',
        'perbelanjaan',
        'unit_perbelanjaan',
        'rm_perbelanjaan',
    ];

    public function paper_work()
    {
        return $this->belongsTo(PaperWork::class, 'paper_work_id', 'id');
    }
}
