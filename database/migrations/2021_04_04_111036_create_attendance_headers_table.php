<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->references('id')->on('class_details')->onUpdate('cascade')->onDelete('cascade');
            $table->string('date');
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
        Schema::dropIfExists('attendance_headers');
    }
}
