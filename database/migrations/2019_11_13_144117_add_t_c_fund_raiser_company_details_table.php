<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTCFundRaiserCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fund_raiser_company_details', function (Blueprint $table) {
            //
            
            $table->enum('terms_con',['Yes','No'])->after('ebitda')->default('No');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fund_raiser_company_details', function (Blueprint $table) {
            //
        });
    }
}
