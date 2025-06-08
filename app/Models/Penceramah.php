<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penceramah extends Model
{
    protected $fillable = [
        'paper_work_id',
        'namaPenceramah',
        'umurPenceramah',
        'alamatPenceramah',
        'emailPenceramah',
        'telefonPenceramah',
        'media_sosialPenceramah',
        'kerjayaPenceramah',
        'bidangPenceramah',
        'pendidikanPenceramah',
        'photoPenceramahPath',
    ];

    public function paper_works()
    {
        return $this->belongsTo(PaperWork::class, 'paper_work_id', 'id');
    }
}
