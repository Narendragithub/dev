<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->integer('google2fa');
            $table->integer('emailotp');
            $table->string('google2fakey');
            $table->string('otp');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
        $table->dropColumn('google2fa');
        $table->dropColumn('emailotp');
        $table->dropColumn('google2fakey');
        $table->dropColumn('otp');
        });
    }
}
