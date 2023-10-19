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
        Schema::table('balas_comments', function (Blueprint $table) {
            $table->foreign('id_pendonor')->references('id')->on('pendonor')->onDelete('cascade');
            $table->foreign('id_comment')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balas_comments', function (Blueprint $table) {
            $table->dropForeign(['id_pendonor']);
            $table->dropForeign(['id_comment']);
        });
    }
};
