<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_header', function (Blueprint $table) {
            $table->id('class_header_id');
            $table->string('name');
            $table->foreignId('school_year_id')->constrained('school_year', 'school_year_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('user', 'user_id')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('class_header');
    }
}
