<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;

class PenyakitController extends Controller
{
    // 1. Menampilkan halaman daftar penyakit (Tabel)
    public function index()
    {
        $data = Penyakit::all();
        return view('admin.penyakit.index', compact('data'));
    }

    // 2. Menampilkan halaman form tambah penyakit
    public function create()
    {
        return view('admin.penyakit.create');
    }

    // 3. Memproses data dari form tambah ke database
    public function store(Request $r)
    {
        $r->validate([
            'kode' => 'required|unique:penyakits,kode', // Mencegah kode duplikat
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        Penyakit::create($r->all());
        return redirect()->route('penyakit.index')->with('success', 'Data penyakit berhasil ditambahkan!');
    }

    // 4. Menampilkan halaman form edit penyakit
    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        return view('admin.penyakit.edit', compact('penyakit'));
    }

    // 5. Memproses perubahan data ke database
    public function update(Request $r, $id)
    {
        $r->validate([
            'kode' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        $penyakit = Penyakit::findOrFail($id);
        $penyakit->update($r->all());

        return redirect()->route('penyakit.index')->with('success', 'Data penyakit berhasil diperbarui!');
    }

    // 6. Menghapus data dari database
    public function destroy($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        $penyakit->delete();

        return redirect()->route('penyakit.index')->with('success', 'Data penyakit berhasil dihapus!');
    }
}