<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuciTangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'unit',
        'tgl_input',
        'sbl_kon_psn',
        'sbl_tin_aseptik',
        'stl_kon_cairan',
        'stl_kon_psn',
        'stl_kon_ling_psn',
        'hr',
        'hw',
        'gagal',
        'st',
    ];
}
