<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAmbil extends Model
{
    
    use HasFactory;

    // protected

    protected $table = 'riwayatambil';
    protected $guarded = [];

    // protected $fillable = [
    //       'pendonor_id',
    // ];

    public function pendonor()
    {
        return $this->belongsTo(Pendonor::class);
    }


}