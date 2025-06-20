<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyToOrganizeEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paper_work_id',
        'nama',
        'no_ic',
        'jawatan_borg_adkn_prog',
        'no_matric',
        'tel_bimbit',
        'email_borg_adkn_prog',
        'alamat_penggal',
        'alamat_cuti',
        'klasifikasi_program',
        'bilangan_kumpulan_pengelola',
        'bilangan_sasaran',
        'kutipan_dari_peserta',
        'tujuan_kutipan_wang',
        'tempat_kutipan',
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
