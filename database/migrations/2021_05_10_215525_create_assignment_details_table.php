<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_header_id');
            $table->unsignedBigInteger('student_user_id')->nullable();
            $table->string('file');
            $table->foreign('assignment_header_id')->references('id')->on('assignment_headers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_user_id')->references('user_id')->on('students')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('assignment_details');
    }
}
