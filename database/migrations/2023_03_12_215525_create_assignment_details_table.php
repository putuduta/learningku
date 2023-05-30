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
        Schema::create('assignment_detail', function (Blueprint $table) {
            $table->id('assignment_detail_id');
            $table->foreignId('assignment_header_id')->constrained('assignment_header', 'assignment_header_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('user', 'user_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('file');
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
        Schema::dropIfExists('assignment_detail');
    }
}
