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
        Schema::create('testimonial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pendonor')->nullable(false);
            $table->text('text')->nullable();
            $table->enum('star', ['1','2','3','4','5'])->nullable(false);
            $table->timestamps();
            $table->foreign('id_pendonor')->references('id')->on('pendonor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial');
    }
};
