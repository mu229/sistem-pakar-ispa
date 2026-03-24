<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\Rule;
use App\Models\Gejala;

class RiwayatController extends Controller
{
    // Menampilkan daftar semua riwayat di Dashboard Admin
    public function index()
    {
        $riwayat = Riwayat::latest()->get();
        // Mengarah ke view admin
        return view('admin.riwayat.index', compact('riwayat'));
    }

    // Menampilkan detail hitungan (Persis Tabel 5 di jurnal)
    public function show($id)
    {
        $riwayat = Riwayat::findOrFail($id);
        
        $gejala_terpilih = $riwayat->gejala_terpilih; // [id_gejala => nilai_cf_user]
        
        $rules = Rule::where('penyakit_id', $riwayat->penyakit_id)
                     ->whereIn('gejala_id', array_keys($gejala_terpilih))
                     ->get();

        $langkah = [];
        $cf_combine = 0;
        $is_first = true;
        $iterasi = 1;

        foreach ($rules as $rule) {
            $gejala = Gejala::find($rule->gejala_id);
            $cf_pakar = $rule->mb - $rule->md; // CF1
            $cf_user = (float) $gejala_terpilih[$rule->gejala_id]; // CF2
            
            if ($cf_user <= 0) continue;

            $cf_old = $cf_pakar * $cf_user; // Cfold

            if ($is_first) {
                $cf_combine = $cf_old; // Perhitungan 1
                $rumus = "Perhitungan $iterasi\n= $cf_pakar * $cf_user\n= $cf_old";
                $is_first = false;
            } else {
                $cf_combine_lama = $cf_combine;
                $cf_combine = $cf_combine_lama + $cf_old * (1 - $cf_combine_lama);
                $rumus = "Perhitungan $iterasi\n= $cf_combine_lama + $cf_old * (1 - $cf_combine_lama)\n= $cf_combine_lama + " . ($cf_old * (1 - $cf_combine_lama)) . "\n= " . round($cf_combine, 8);
            }

            $langkah[] = [
                'kode_gejala' => $gejala->kode,
                'cf1' => $cf_pakar,
                'cf2' => $cf_user,
                'cf_old' => round($cf_old, 2),
                'cf_combine' => round($cf_combine, 8),
                'teks_rumus' => $rumus
            ];

            $iterasi++;
        }

        // Mengarah ke view admin
        return view('admin.riwayat.show', compact('riwayat', 'langkah'));
    }
}