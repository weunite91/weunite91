<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumInTeamDeginatUsersTable extends Migration
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
            $table->string('team_mem_deg1')->after('team_mem4')->nullable();
            $table->string('team_mem_deg2')->after('team_mem_deg1')->nullable();
            $table->string('team_mem_deg3')->after('team_mem_deg2')->nullable();
            $table->string('team_mem_deg4')->after('team_mem_deg3')->nullable();
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
