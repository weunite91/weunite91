<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColoumToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->enum('staff_verify_status',['0','1'])->after('verify_status')->default(0);
            $table->enum('admin_verify_status',['0','1'])->after('staff_verify_status')->default(0);
            $table->string('ip')->after('admin_verify_status');
            $table->enum('user_type',['P','R'])->after('ip')->default('P');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
