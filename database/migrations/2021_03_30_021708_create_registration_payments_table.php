<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_payments', function (Blueprint $table) {
            $table->id();
            $table->string('pic_name');
            $table->string('pic_email')->unique();
            $table->string('institution_name')->unique();
            $table->string('institution_email')->unique();
            $table->string('institution_address');
            $table->string('phone_number')->unique();
            $table->string('transfer_proof');
            $table->integer('is_confirmed')->default(0);
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
        Schema::dropIfExists('registration_payments');
    }
}
