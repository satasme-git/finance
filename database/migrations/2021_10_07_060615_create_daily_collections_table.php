<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_collections', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number');
            $table->double('pay_amount');
            $table->string('installement_date');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('cre_id');
            $table->foreign('cre_id')->references('id')->on('creditors');
            $table->unsignedBigInteger('loan_id');
            $table->foreign('loan_id')->references('id')->on('loans');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('daily_collections');
    }
}
