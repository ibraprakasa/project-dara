<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class GolonganDarah extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $table = 'golongandarah';
     protected $primaryKey = 'id_stok';
     protected $guarded = [];
 
     public function pendonor()
     {
         return $this->hasMany(Pendonor::class, 'id_golongan_darah', 'id');
     }
 
     public function stokDarah()
     {
         return $this->hasMany(StokDarah::class, 'gol_darah', 'id');
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