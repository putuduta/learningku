<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_subject_id');
            $table->foreign('class_subject_id')->references('id')->on('class_subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->string('file');
            $table->string('end_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_headers');
    }
}
