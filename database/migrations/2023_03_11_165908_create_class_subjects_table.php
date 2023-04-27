<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('class_header_id');
            $table->foreign('class_header_id')->references('id')->on('class_headers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('teacher_user_id');
            $table->foreign('teacher_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('minimum_score');
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
        Schema::dropIfExists('class_headers');
    }
}