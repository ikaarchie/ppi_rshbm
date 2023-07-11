<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleISKSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_i_s_k_s', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->string('nama_pasien');
            $table->string('diagnosa');
            $table->string('unit');
            $table->string('tgl');
            $table->string('ISK0101');
            $table->string('ISK0102');
            $table->string('ISK0103');
            $table->string('ISK0104');
            $table->string('ISK0201');
            $table->string('ISK0202');
            $table->string('ISK0203');
            $table->string('ISK0204');
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
        Schema::dropIfExists('bundle_i_s_k_s');
    }
}
