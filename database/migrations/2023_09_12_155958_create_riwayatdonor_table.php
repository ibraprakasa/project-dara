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
            $table->integer('jumlah_donor')->nullable(false);
            $table->date('tanggal_donor')->nullable(false);
            $table->string('lokasi_donor',100)->nullable(false);
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
