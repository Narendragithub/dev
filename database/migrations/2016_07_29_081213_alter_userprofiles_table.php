<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userprofile', function($table) {
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->decimal('balance', 10, 4)->unsigned();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userprofile', function($table) {
        $table->dropColumn('phone');
        $table->dropColumn('address');
        $table->dropColumn('city');
        $table->dropColumn('state');
        $table->dropColumn('zip');
        $table->dropColumn('balance');
        });
    }
}
