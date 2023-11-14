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

    protected $fillable = [
        'gambar',
        'nama',
        'email',
        'tanggal_lahir',
        'kode_pendonor',
        'jenis_kelamin',
        'id_golongan_darah',
        'berat_badan',
        'kontak_pendonor',
        'alamat_pendonor',
        'password',
        'stok_darah_tersedia',
    ];

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

    public function posts()
    {
        return $this->hasMany(Post::class, 'id_pendonor', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_pendonor');
    }

    public function reply()
    {
        return $this->hasMany(BalasComment::class, 'id_pendonor');
    }

    public function reports()
    {
        return $this->hasMany(Laporan::class, 'id_pendonor');
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

