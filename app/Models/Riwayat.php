<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pasien', 'gejala_terpilih', 'penyakit_id', 'nama_penyakit', 'persentase'
    ];

    // Otomatis convert format JSON dari database menjadi Array PHP
    protected $casts = [
        'gejala_terpilih' => 'array'
    ];
}