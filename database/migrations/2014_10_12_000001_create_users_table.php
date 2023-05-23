<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_code');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('gender');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('role_id')->on('role')->onUpdate('cascade')->onDelete('cascade');
            $table->string('photo_profile')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
