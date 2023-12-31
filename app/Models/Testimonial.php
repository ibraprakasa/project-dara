<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;;

class Testimonial extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'testimonial';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_pendonor',
        'text',
        'star',
        'status',
        'created_at',
        'updated_at'
    ];

    public function pendonor()
    {
         return $this->belongsTo(Pendonor::class, 'id_pendonor', 'id');
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
