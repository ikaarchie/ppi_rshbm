<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlePlebitisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_plebitis', function (Blueprint $table) {
            $table->id();
            $table->string('mrn');
            $table->string('nama_pasien');
            $table->string('diagnosa');
            $table->string('unit');
            $table->string('tgl');
            $table->string('PLB0301');
            $table->string('PLB0302');
            $table->string('PLB0303');
            $table->string('PLB0304');
            $table->string('PLB0201');
            $table->string('PLB0202');
            $table->string('PLB0203');
            $table->string('PLB0204');
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
        Schema::dropIfExists('bundle_plebitis');
    }
}
