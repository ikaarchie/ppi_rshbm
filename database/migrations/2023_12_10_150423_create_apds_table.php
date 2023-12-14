<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apds', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('unit');
            $table->string('tgl_input');
            $table->string('pntp_kpl'); //penutup kepala
            $table->string('masker'); //masker
            $table->string('pntp_wjh'); //kacamata google atau faceshield
            $table->string('apron'); //apron
            $table->string('srg_tgn'); //sarung tangan
            $table->string('alas_kaki'); //sandal atau sepatu boot
            $table->string('lps_apd'); //segera melepas apd selesai melakukan
            $table->string('tdk_gtg_masker'); //tidak menggantung masker di leher
            $table->string('tdk_guna_srg_tgn'); //tidak menggunakan sarung tangan sambil menulis atau menyentuh lingkungan yg tdk direkomendasikan
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
        Schema::dropIfExists('apds');
    }
}
