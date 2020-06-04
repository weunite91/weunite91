<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestorDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_details', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->integer('user_id');
             $table->integer('designation');
             $table->string('companyname')->nullable();
             $table->string('website')->nullable();
             $table->string('phone_number')->nullable();
             $table->text('address');
             $table->integer('country');
             $table->integer('state');
             $table->integer('city');
             $table->integer('pincode')->nullable();
             $table->integer('industry');
             $table->string('gst')->nullable();
             $table->string('investortype');
             $table->string('interestin');
             $table->text('intro');
             $table->text('company_intro');
             $table->bigInteger('min_investment');
            $table->bigInteger('max_investment');
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
        Schema::dropIfExists('investor_details');
    }
}
