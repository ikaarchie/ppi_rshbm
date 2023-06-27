<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuciTangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuci_tangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('unit');
            $table->string('tgl_input');
            $table->string('sbl_kon_psn');
            $table->string('sbl_tin_aseptik');
            $table->string('stl_kon_cairan');
            $table->string('stl_kon_psn');
            $table->string('stl_kon_ling_psn');
            $table->string('hr');
            $table->string('hw');
            $table->string('gagal');
            $table->string('st');
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
        Schema::dropIfExists('cuci_tangans');
    }
}
