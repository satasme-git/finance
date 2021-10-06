<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number');
            $table->double('loan_amount');
            $table->string('loan_rental_freq');
            $table->integer('loan_period');
            $table->double('loan_with_int');
            $table->double('loan_installement');
            $table->integer('loan_term');
            $table->string('loan_start_date');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('cre_id');
            $table->foreign('cre_id')->references('id')->on('creditors');
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
        Schema::dropIfExists('loans');
    }
}
