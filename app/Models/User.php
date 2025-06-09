<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'username',
        'email',
        'password',
        'admin_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'admin_verified' => 'boolean',
        ];
    }

    public function roles(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id','id');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function paper_works(): HasMany
    {
        return $this->hasMany(PaperWork::class);
    }

    public function apply_to_organize_events(): HasMany
    {
        return $this->hasMany(ApplyToOrganizeEvent::class);
    }

    public function mycsd_maps(): HasMany
    {
        return $this->hasMany(MycsdMap::class);
    }

    public function advisor(): HasMany
    {
        return $this->hasMany(Advisor::class);
    }
}
