<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleIDOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_i_d_o_s', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->string('nama_pasien');
            $table->string('diagnosa');
            $table->string('tindakan');
            $table->string('unit');
            $table->string('tgl');
            $table->string('IDO04A01');
            $table->string('IDO04A02');
            $table->string('IDO04A03');
            $table->string('IDO04A04');
            $table->string('IDO04A05');
            $table->string('IDO04A06');
            $table->string('IDO04A07');
            $table->string('IDO04A08');
            $table->string('IDO04B01');
            $table->string('IDO04B02');
            $table->string('IDO04B03');
            $table->string('IDO05A01');
            $table->string('IDO05A02');
            $table->string('IDO05A03');
            $table->string('IDO05A04');
            $table->string('IDO05B01');
            $table->string('IDO05B02');
            $table->string('IDO05B03');
            $table->string('IDO05B04');
            $table->string('IDO0601');
            $table->string('IDO0602');
            $table->string('IDO0603');
            $table->string('IDO0604');
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
        Schema::dropIfExists('bundle_i_d_o_s');
    }
}
