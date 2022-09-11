<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('class_id')->references('id')->on('class_details')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('day');
            $table->string('start_time');
            $table->string('end_time');
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
        Schema::dropIfExists('class_courses');
    }
}
