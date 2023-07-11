<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundlePlebitis extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'nama_pasien',
        'diagnosa',
        'unit',
        'tgl',
        'PLB0301',
        'PLB0302',
        'PLB0303',
        'PLB0304',
        'PLB0201',
        'PLB0202',
        'PLB0203',
        'PLB0204',
    ];
}
