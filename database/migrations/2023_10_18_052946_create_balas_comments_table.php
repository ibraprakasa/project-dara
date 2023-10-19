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
        Schema::create('balas_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pendonor')->nullable(false);
            $table->unsignedBigInteger('id_comment')->nullable(false);
            $table->text('text')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balas_comments');
    }
};
