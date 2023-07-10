<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MstKodeBundle extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'deskripsi',
        'fungsi',
        'jenis',
    ];
}
