<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonial';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_pendonor',
        'text',
        'star',
    ];

    public function pendonor()
    {
         return $this->hasMany(Pendonor::class, 'id_pendonor', 'id');
    }
}
