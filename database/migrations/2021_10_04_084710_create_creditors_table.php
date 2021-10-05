<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditors', function (Blueprint $table) {
            $table->id();
            $table->string('cre_first_Name');
            $table->string('cre_last_Name');
            $table->string('cre_nic_number')->unique();
            $table->string('cre_DOB');
            $table->string('cre_gender');
            $table->string('cre_phone_number');
            $table->string('cre_address');
            $table->string('cre_image')->default("null");
            $table->tinyInteger('status');
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
        Schema::dropIfExists('creditors');
    }
}
