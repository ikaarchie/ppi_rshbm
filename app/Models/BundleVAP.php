<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleVAP extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'nama_pasien',
        'diagnosa',
        'unit',
        'tgl',
        'VAP0101',
        'VAP0102',
        'VAP0103',
        'VAP0104',
        'VAP0201',
        'VAP0202',
        'VAP0203',
        'VAP0204',
        'VAP0205',
        'VAP0206',
        'VAP0207',
        'VAP0208',
    ];
}
