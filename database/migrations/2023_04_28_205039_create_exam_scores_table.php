<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_user_id');
            $table->foreign('student_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('class_subject_id');
            $table->foreign('class_subject_id')->references('id')->on('class_subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->integer('score');
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
        Schema::dropIfExists('exam_scores');
    }
}
