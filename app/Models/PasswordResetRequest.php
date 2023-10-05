<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetRequest extends Model
{
    use HasFactory;

    // Nama tabel yang sesuai dengan model
    protected $table = 'password_reset_requests';

    // Kolom yang dapat diisi
    protected $fillable = ['email', 'otp'];
}
?>