<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->string('client_id');
            $table->string('client_secret');
            $table->string('redirect');
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
        Schema::drop('socialsettings');
    }
}
