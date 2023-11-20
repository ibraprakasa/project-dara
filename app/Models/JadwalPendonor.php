<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class JadwalPendonor extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'jadwalpendonor';
    protected $guard = [];

    protected $fillable = [
        'id_pendonor',
        'id_jadwal_donor_darah'
    ];

    public function jadwalDonor()
    {
        return $this->belongsTo(JadwalDonor::class, 'id');
    }

    public function pendonor(){
        return $this->belongsTo(Pendonor::class, 'id_pendonor','id');
    }

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
