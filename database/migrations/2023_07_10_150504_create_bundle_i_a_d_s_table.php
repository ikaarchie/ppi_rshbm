<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleIADSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_i_a_d_s', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->string('nama_pasien');
            $table->string('diagnosa');
            $table->string('unit');
            $table->string('tgl');
            $table->string('IAD0301');
            $table->string('IAD0302');
            $table->string('IAD0303');
            $table->string('IAD0304');
            $table->string('IAD0201');
            $table->string('IAD0202');
            $table->string('IAD0203');
            $table->string('IAD0204');
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
        Schema::dropIfExists('bundle_i_a_d_s');
    }
}
