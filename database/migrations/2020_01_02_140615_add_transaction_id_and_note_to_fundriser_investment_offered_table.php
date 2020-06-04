<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionIdAndNoteToFundriserInvestmentOfferedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fundriser_investment_offered', function (Blueprint $table) {
            $table->string('transaction_id')->after('payment_status')->nullable();
            $table->text('note')->after('transaction_id')->nullable();
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
