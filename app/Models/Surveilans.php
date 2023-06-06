<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surveilans extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'nama_pasien',
        'usia',
        'jenis_kelamin',
        'unit',
        'pa_ivl',
        'pa_dc',
        'pa_vent',
        'pa_iad',
        'hais_plebitis',
        'hais_isk',
        'hais_vap',
        'hais_iad',
        'hais_deku',
        'hais_hap',
        'hais_ido',
        'terpajan',
        'tirah_baring',
        'tgl_input',
    ];
}
