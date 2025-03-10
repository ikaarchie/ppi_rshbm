<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataDetail extends Model
{
    use HasFactory;

    protected $fillable = ['pengguna_id', 'data1', 'data2', 'data3'];

    public function penggunas()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
