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
        Schema::table('pendonor', function (Blueprint $table) {
            $table->foreign('id_golongan_darah')->references('id')->on('golongandarah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendonor', function (Blueprint $table) {
            $table->dropForeign(['id_golongan_darah']);
        });
    }
};
