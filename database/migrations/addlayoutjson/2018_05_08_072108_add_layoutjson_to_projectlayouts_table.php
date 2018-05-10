<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLayoutjsonToProjectlayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projectlayouts', function (Blueprint $table) {
            DB::statement('ALTER TABLE projectlayouts ADD COLUMN layoutjson text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projectlayouts', function (Blueprint $table) {
            //
        });
    }
}
