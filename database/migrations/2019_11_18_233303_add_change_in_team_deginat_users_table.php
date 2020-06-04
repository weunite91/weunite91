<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeInTeamDeginatUsersTable extends Migration
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
            $table->dropColumn(['team_mem_deg1']);
            $table->dropColumn(['team_mem_deg2']);
            $table->dropColumn(['team_mem_deg3']);
            $table->dropColumn(['team_mem_deg4']);
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
