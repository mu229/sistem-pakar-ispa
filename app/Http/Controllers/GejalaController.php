<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;

class GejalaController extends Controller
{
    // 1. Menampilkan halaman daftar gejala (Tabel)
    public function index()
    {
        $data = Gejala::all();
        return view('admin.gejala.index', compact('data'));
    }

    // 2. Menampilkan halaman form tambah gejala
    public function create()
    {
        return view('admin.gejala.create');
    }

    // 3. Memproses data dari form tambah ke database
    public function store(Request $r)
    {
        $r->validate([
            'kode' => 'required|unique:gejalas,kode', // Tambah validasi unique agar kode tidak kembar
            'nama' => 'required'
        ]);

        Gejala::create($r->all());
        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil ditambahkan!');
    }

    // 4. Menampilkan halaman form edit gejala
    public function edit($id)
    {
        $gejala = Gejala::findOrFail($id);
        return view('admin.gejala.edit', compact('gejala'));
    }

    // 5. Memproses perubahan data ke database
    public function update(Request $r, $id)
    {
        $r->validate([
            'kode' => 'required',
            'nama' => 'required'
        ]);

        $gejala = Gejala::findOrFail($id);
        $gejala->update($r->all());

        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil diperbarui!');
    }

    // 6. Menghapus data dari database
    public function destroy($id)
    {
        $gejala = Gejala::findOrFail($id);
        $gejala->delete();

        return redirect()->route('gejala.index')->with('success', 'Data gejala berhasil dihapus!');
    }
}