<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BundleIDO extends Model
{
    use HasFactory;

    protected $fillable = [
        'mrn',
        'nama_pasien',
        'diagnosa',
        'tindakan',
        'unit',
        'tgl',
        'IDO04A01',
        'IDO04A02',
        'IDO04A03',
        'IDO04A04',
        'IDO04A05',
        'IDO04A06',
        'IDO04A07',
        'IDO04A08',
        'IDO04B01',
        'IDO04B02',
        'IDO04B03',
        'IDO05A01',
        'IDO05A02',
        'IDO05A03',
        'IDO05A04',
        'IDO05B01',
        'IDO05B02',
        'IDO05B03',
        'IDO05B04',
        'IDO0601',
        'IDO0602',
        'IDO0603',
        'IDO0604',
    ];
}
