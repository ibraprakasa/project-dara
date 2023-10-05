<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokDarah extends Model
{
    use HasFactory;
    
    protected $table = 'stokdarah';
    protected $primaryKey = 'id_stok';
    protected $guarded = [];

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class, 'gol_darah', 'id');
    }

}
