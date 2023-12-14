<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apd extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'unit',
        'tgl_input',
        'pntp_kpl',
        'masker',
        'pntp_wjh',
        'apron',
        'srg_tgn',
        'alas_kaki',
        'lps_apd',
        'tdk_gtg_masker',
        'tdk_guna_srg_tgn',
    ];
}
