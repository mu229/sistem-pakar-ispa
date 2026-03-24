<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Penyakit;

class RuleController extends Controller
{
    // 1. Menampilkan tabel daftar rule
    public function index()
    {
        $data = Rule::all();
        return view('admin.rule.index', compact('data'));
    }

    // 2. Menampilkan form tambah rule
    public function create()
    {
        // Harus mengambil data penyakit dan gejala untuk ditampilkan di dropdown (select)
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        
        return view('admin.rule.create', compact('penyakit', 'gejala'));
    }

    // 3. Memproses data dari form tambah ke database
    public function store(Request $r)
    {
        $r->validate([
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'mb' => 'required|numeric',
            'md' => 'required|numeric'
        ]);

        Rule::create($r->all());
        return redirect()->route('rule.index')->with('success', 'Data Rule berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit rule
    public function edit($id)
    {
        $rule = Rule::findOrFail($id);
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        
        return view('admin.rule.edit', compact('rule', 'penyakit', 'gejala'));
    }

    // 5. Memproses perubahan data ke database
    public function update(Request $r, $id)
    {
        $r->validate([
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'mb' => 'required|numeric',
            'md' => 'required|numeric'
        ]);

        $rule = Rule::findOrFail($id);
        $rule->update($r->all());

        return redirect()->route('rule.index')->with('success', 'Data Rule berhasil diperbarui!');
    }

    // 6. Menghapus data dari database
    public function destroy($id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();

        return redirect()->route('rule.index')->with('success', 'Data Rule berhasil dihapus!');
    }
}