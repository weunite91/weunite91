<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumsStateAndCityFundRaiseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fund_raise_details', function (Blueprint $table) {
            //
            $table->integer('state')->after('country')->nullable();
            $table->integer('city')->after('state')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fund_raise_details', function (Blueprint $table) {
            //
        });
    }
}
