<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundriserInvestmentOfferedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundriser_investment_offered', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('pitch_id');
            $table->integer('user_id');
            $table->integer('ammount');
            $table->integer('commision');
            $table->enum('payment_status',['P','S','F'])->default('P');
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
        Schema::dropIfExists('fundriser_investment_offered');
    }
}
