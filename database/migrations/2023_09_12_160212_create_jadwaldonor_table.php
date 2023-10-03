<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwaldonor', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi',100)->nullable(false);
            $table->string('alamat',255)->nullable(false);
            $table->date('tanggal_donor')->nullable(false);
            $table->time('jam_mulai')->nullable(false);
            $table->time('jam_selesai')->nullable(false);
            $table->string('kontak',20)->nullable(false);
            $table->integer('jumlah_pendonor')->nullable(false);
            $table->double('latitude')->nullable(false);
            $table->double('longitude')->nullable(false);
            // $table->enum('status', ['Belum Selesai', 'Selesai']); // Kolom ENUM 'status' dengan pilihan tertentu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwaldonor');
    }
};
