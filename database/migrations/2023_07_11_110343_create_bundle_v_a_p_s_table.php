<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleVAPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_v_a_p_s', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->string('nama_pasien');
            $table->string('diagnosa');
            $table->string('unit');
            $table->string('tgl');
            $table->string('VAP0101');
            $table->string('VAP0102');
            $table->string('VAP0103');
            $table->string('VAP0104');
            $table->string('VAP0201');
            $table->string('VAP0202');
            $table->string('VAP0203');
            $table->string('VAP0204');
            $table->string('VAP0205');
            $table->string('VAP0206');
            $table->string('VAP0207');
            $table->string('VAP0208');
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
        Schema::dropIfExists('bundle_v_a_p_s');
    }
}
