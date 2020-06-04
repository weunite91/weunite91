<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColoumToFundriserInvestmentOfferedTable extends Migration
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
            $table->dropColumn(['ammount','commision']);
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
