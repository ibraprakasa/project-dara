<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Laporan extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'reports';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
       'id_pendonor',
       'id_post',
       'id_comment',
       'id_reply',
       'text',
       'type',
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

    public function pendonor()
    {
        return $this->belongsTo(Pendonor::class, 'id_pendonor');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function comments()
    {
        return $this->belongsTo(Comment::class, 'id_comment');
    }

    public function reply()
    {
        return $this->belongsTo(BalasComment::class, 'id_reply');
    }
}
