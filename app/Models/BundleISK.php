<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleISK extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'nama_pasien',
        'diagnosa',
        'unit',
        'tgl',
        'ISK0101',
        'ISK0102',
        'ISK0103',
        'ISK0104',
        'ISK0201',
        'ISK0202',
        'ISK0203',
        'ISK0204',
    ];
}
