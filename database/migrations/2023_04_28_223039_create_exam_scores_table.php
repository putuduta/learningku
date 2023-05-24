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
        Schema::create('exam_score', function (Blueprint $table) {
            $table->id('exam_score_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onUpdate('cascade')->onDelete('cascade');
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
