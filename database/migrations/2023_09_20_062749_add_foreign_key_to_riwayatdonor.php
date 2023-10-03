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
        Schema::table('riwayatdonor', function (Blueprint $table) {
            $table->foreign('pendonor_id')->references('id')->on('pendonor');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayatdonor', function (Blueprint $table) {
            $table->dropForeign(['pendonor_id']);
        });
    }
};
