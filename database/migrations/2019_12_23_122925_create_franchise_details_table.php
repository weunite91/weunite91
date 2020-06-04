<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchiseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchise_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->bigInteger('min_investment');
            $table->bigInteger('max_investment');
            $table->bigInteger('min_investment_accepated')->nullable();
            $table->text('usp1')->nullable();
            $table->text('usp2')->nullable();
            $table->text('usp3')->nullable();
            $table->text('usp4')->nullable();
            $table->text('intro');
            $table->text('idea');
            $table->text('team');
            $table->string('team_mem1');
            $table->string('team_mem2')->nullable();
            $table->string('team_mem3')->nullable();
            $table->string('team_mem4')->nullable();
            $table->string('team_mem_deg1');
            $table->string('team_mem_deg2')->nullable();
            $table->string('team_mem_deg3')->nullable();
            $table->string('team_mem_deg4')->nullable();
            $table->string('member_image')->nullable();
            $table->string('video')->nullable();
            $table->bigInteger('roi')->nullable();
            $table->bigInteger('cop')->nullable();
            $table->bigInteger('pi')->nullable();
            $table->bigInteger('dividend')->nullable();
            $table->bigInteger('fa')->nullable();
            $table->bigInteger('ebitda')->nullable();
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
        Schema::dropIfExists('franchise_details');
    }
}
