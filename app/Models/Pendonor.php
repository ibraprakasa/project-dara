<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Pendonor extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pendonor';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function jadwalPendonor()
    {
        return $this->hasMany(JadwalPendonor::class, 'id_pendonor','id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class, 'id_golongan_darah', 'id');
    }

    public function riwayatDonor()
    {
        return $this->hasMany(RiwayatDonor::class, 'pendonor_id', 'id');
    }

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}

