<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Comment extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
       'id_pendonor',
       'id_post',
       'text',
       'created_at',
       'updated_at'
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

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post'); // Sesuaikan dengan nama kolom yang digunakan di tabel comments
    }

    public function reply()
    {
        return $this->hasMany(BalasComment::class, 'id_comment'); // Sesuaikan dengan nama kolom yang digunakan di tabel comments
    }

    public function pendonor()
    {
        return $this->belongsTo(Pendonor::class, 'id_pendonor');
    }

    public function reports()
    {
        return $this->hasMany(Laporan::class, 'id_pendonor');
    }
}
