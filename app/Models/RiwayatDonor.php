<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatDonor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_riwayat';
    protected $table = "riwayatdonor";
    protected $guarded = [];

    public function pendonor()
    {
        return $this->belongsTo(Pendonor::class, 'pendonor_id', 'id');
    }
}
