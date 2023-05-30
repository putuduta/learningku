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
        Schema::create('attendance_header', function (Blueprint $table) {
            $table->id('attendance_header_id');
            $table->foreignId('class_subject_id')->constrained('class_subject', 'class_subject_id')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('attendance_header');
    }
}
