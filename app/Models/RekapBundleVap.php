<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBundleVap extends Model
{
    use HasFactory;

    protected $fillable = [
        'dari',
        'sampai',
        'analisa',
        'tindak_lanjut',
    ];
}
