<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jawatankuasa extends Model
{
    protected $table = 'jawatankuasa';
    protected $fillable = [
        'paper_work_id',
        'jawatan',
        'nama_pemegang_jawatan',
        'no_matrik_pemegang_jawatan',
        'tahun_pemegang_jawatan',
        'pusat_tanggungjawab',
    ];

    public function paper_work()
    {
        return $this->belongsTo(PaperWork::class, 'paper_work_id', 'id');
    }
}
