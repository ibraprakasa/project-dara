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
        Schema::create('riwayatdonor', function (Blueprint $table) {
            $table->id('id_riwayat');
            $table->unsignedBigInteger('pendonor_id');
            $table->integer('jumlah_donor');
            $table->date('tanggal_donor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatdonor');
    }
};
