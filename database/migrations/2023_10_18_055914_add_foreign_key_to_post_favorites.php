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
        Schema::table('post_favorites', function (Blueprint $table) {
            $table->foreign('id_pendonor')->references('id')->on('pendonor')->onDelete('cascade');
            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_favorites', function (Blueprint $table) {
            $table->dropForeign(['id_pendonor']);
            $table->dropForeign(['id_post']);
        });
    }
};
