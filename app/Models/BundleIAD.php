<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleIAD extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'nama_pasien',
        'diagnosa',
        'unit',
        'tgl',
        'IAD0301',
        'IAD0302',
        'IAD0303',
        'IAD0304',
        'IAD0201',
        'IAD0202',
        'IAD0203',
        'IAD0204',
    ];
}
