<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorProposalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_proposal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('investordetailsid');
            $table->string('firstname');
            $table->string('profile_code');
            $table->string('amount');
            $table->text('message');
            $table->enum('appove',['approve','pending','rejected'])->default('pending');
            $table->integer('appoveby')->nullable();
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
        Schema::dropIfExists('investor_proposal');
    }
}
