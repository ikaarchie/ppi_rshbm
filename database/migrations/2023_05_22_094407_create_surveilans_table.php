<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveilansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveilans', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->string('nama_pasien');
            $table->string('usia');
            $table->string('jenis_kelamin');
            $table->string('unit');
            $table->string('pa_ivl');
            $table->string('pa_dc');
            $table->string('pa_vent');
            $table->string('pa_iad');
            $table->string('hais_plebitis');
            $table->string('hais_isk');
            $table->string('hais_vap');
            $table->string('hais_iad');
            $table->string('hais_deku');
            $table->string('hais_hap');
            $table->string('hais_ido');
            $table->string('terpajan');
            $table->string('tirah_baring');
            $table->string('tgl_input');
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
        Schema::dropIfExists('surveilans');
    }
}
