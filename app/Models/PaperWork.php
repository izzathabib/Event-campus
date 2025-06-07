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
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'lokasi',
        'collaboration',
        'penaja',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function apply_to_organize_events()
    {
        return $this->hasOne(ApplyToOrganizeEvent::class);
    }

    public function mycsd_maps()
    {
        return $this->hasOne(MycsdMap::class);
    }

    public function event_days()
    {
        return $this->hasMany(EventDay::class);
    }

    public function jawatankuasa()
    {
        return $this->hasMany(Jawatankuasa::class);
    }

    public function belanjawans()
    {
        return $this->hasOne(Belanjawan::class);
    }

}
