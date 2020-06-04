<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChnageColoumToFundriserInvestmentOfferedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fundriser_investment_offered', function (Blueprint $table) {
            //
            $table->bigInteger('ammount')->after('user_id');
            $table->bigInteger('commision')->after('ammount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fundriser_investment_offered', function (Blueprint $table) {
            //
        });
    }
}
