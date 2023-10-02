<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendonor extends Model
{
    use HasFactory;

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


}
