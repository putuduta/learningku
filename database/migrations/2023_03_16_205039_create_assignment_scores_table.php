<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_score', function (Blueprint $table) {
            $table->id('assignment_score_id');
            $table->unsignedBigInteger('assignment_header_id');
            $table->foreign('assignment_header_id')->references('assignment_header_id')->on('assignment_header')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('score')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('assignment_score');
    }
}
