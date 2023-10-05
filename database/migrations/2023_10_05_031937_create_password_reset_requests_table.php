<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('password_reset_requests', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->integer('otp');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_reset_requests');
    }
}
?>