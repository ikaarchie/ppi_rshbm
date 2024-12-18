<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVAP0209ToBundleVAPS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bundle_v_a_p_s', function (Blueprint $table) {
            $table->string('VAP0209')->default('td');
            $table->string('VAP0210')->default('td');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bundle_v_a_p_s', function (Blueprint $table) {
            //
        });
    }
}
