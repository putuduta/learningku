<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material', function (Blueprint $table) {
            $table->id('material_id');
            $table->unsignedBigInteger('class_subject_id');
            $table->foreign('class_subject_id')->references('class_subject_id')->on('class_subject')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title');
            $table->mediumText('description');
            $table->string('resource');
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
        Schema::dropIfExists('materials');
    }
}
