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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pendonor')->nullable(false);
            $table->unsignedBigInteger('id_post')->nullable();
            $table->unsignedBigInteger('id_comment')->nullable();
            $table->unsignedBigInteger('id_reply')->nullable();
            $table->text('text')->nullable(false);
            $table->enum('type',['Postingan','Komentar','Balasan'])->nullable(false);
            $table->timestamps();

            $table->foreign('id_pendonor')->references('id')->on('pendonor')->onDelete('cascade');
            $table->foreign('id_post')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('id_comment')->references('id')->on('comments')->onDelete('cascade');
            $table->foreign('id_reply')->references('id')->on('balas_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
