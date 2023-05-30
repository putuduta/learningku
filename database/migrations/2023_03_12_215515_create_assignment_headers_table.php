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
        Schema::create('assignment_header', function (Blueprint $table) {
            $table->id('assignment_header_id');
            $table->foreignId('class_subject_id')->constrained('class_subject', 'class_subject_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->string('file');
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
        Schema::dropIfExists('assignment_header');
    }
}
