<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;

class DiagnosaController extends Controller
{
    // 1. Method untuk MENAMPILKAN halaman form diagnosa (Solusi dari error kamu)
    public function index()
    {
        // Ambil semua data gejala untuk ditampilkan di checkbox/dropdown form
        $gejala = Gejala::all();
        
        // Return ke view form diagnosa
        // Asumsi nama file blade kamu adalah: resources/views/diagnosa.blade.php
     return view('user.diagnosa', compact('gejala'));
    }

    // 2. Method untuk MEMPROSES perhitungan setelah tombol submit ditekan
    public function proses(Request $request)
    {
        // Validasi input agar tidak error jika dikosongkan
        $request->validate([
            'nama' => 'required|string|max:255',
            'gejala' => 'required|array'
        ]);

        $nama_pasien = $request->nama;
        $input_gejala = $request->input('gejala'); // Format: [gejala_id => nilai_cf_user]

        $hasil_diagnosa = [];
        $semua_penyakit = Penyakit::all();

        foreach ($semua_penyakit as $penyakit) {
            $cf_combine = 0;
            $is_first_rule = true;

            // Ambil semua rule yang terkait dengan penyakit ini
            $rules = Rule::where('penyakit_id', $penyakit->id)->get();

            if ($rules->count() > 0) {
                foreach ($rules as $rule) {
                    // Cek apakah gejala pada rule ini dipilih oleh user dan nilainya > 0
                    if (isset($input_gejala[$rule->gejala_id]) && $input_gejala[$rule->gejala_id] > 0) {
                        
                        $cf_pakar = $rule->mb - $rule->md; // Rumus: CF(H,E) = MB - MD
                        $cf_user = (float) $input_gejala[$rule->gejala_id]; // Nilai yang dipilih user di dropdown
                        
                        $cf_old = $cf_pakar * $cf_user; // Rumus: CF Pakar * CF User

                        // Perhitungan CF Combine Sesuai Jurnal
                        if ($is_first_rule) {
                            $cf_combine = $cf_old; // Perhitungan pertama langsung masuk
                            $is_first_rule = false;
                        } else {
                            // Perhitungan kedua dst: CF1 + CF2 * (1 - CF1)
                            $cf_combine = $cf_combine + $cf_old * (1 - $cf_combine);
                        }
                    }
                }

                // Jika ada kecocokan gejala (cf_combine > 0), simpan hasilnya
                if ($cf_combine > 0) {
                    $persentase = $cf_combine * 100;
                    $hasil_diagnosa[] = [
                        'penyakit_id' => $penyakit->id,
                        'nama_penyakit' => $penyakit->nama,
                        'nilai_cf' => $cf_combine,
                        'persentase' => round($persentase, 2)
                    ];
                }
            }
        }

        usort($hasil_diagnosa, function($a, $b) {
            return $b['persentase'] <=> $a['persentase'];
        });

        // ----------------- TAMBAHKAN KODE INI -----------------
        $id_riwayat = null;
        if (count($hasil_diagnosa) > 0) {
            // Filter hanya gejala yang memiliki CF > 0 yang disimpan
            $gejala_valid = array_filter($input_gejala, function($val) {
                return $val > 0;
            });

            // Simpan ke tabel riwayat
            $riwayat = \App\Models\Riwayat::create([
                'nama_pasien' => $nama_pasien,
                'gejala_terpilih' => $gejala_valid,
                'penyakit_id' => $hasil_diagnosa[0]['penyakit_id'],
                'nama_penyakit' => $hasil_diagnosa[0]['nama_penyakit'],
                'persentase' => $hasil_diagnosa[0]['persentase']
            ]);
            $id_riwayat = $riwayat->id;
        }
        // ------------------------------------------------------

        // Urutkan array berdasarkan persentase tertinggi ke terendah
        usort($hasil_diagnosa, function($a, $b) {
            return $b['persentase'] <=> $a['persentase'];
        });

        // Lempar data ke halaman hasil
        // Asumsi nama file blade kamu adalah: resources/views/hasil_diagnosa.blade.php
    return view('user.hasil', compact('hasil_diagnosa', 'nama_pasien', 'id_riwayat'));
    
    }
}