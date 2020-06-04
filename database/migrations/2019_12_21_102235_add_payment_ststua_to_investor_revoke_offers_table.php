<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStstuaToInvestorRevokeOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investor_revoke_offers', function (Blueprint $table) {
            $table->enum('payment_status',['Pending','Paid','Rejected'])->default('Pending')->after('commision');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investor_revoke_offers', function (Blueprint $table) {
            //
        });
    }
}
