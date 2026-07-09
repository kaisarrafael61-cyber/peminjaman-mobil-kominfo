<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    // Paksa menggunakan nama tabel tunggal universal
    protected $table = 'peminjaman';

    protected $guarded = [];
}