<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'penggunas'; // Menentukan tabel pengguna
    protected $fillable = ['nomor_induk', 'name'];

    public function dataDetails()
    {
        return $this->hasMany(DataDetail::class);
    }
}
