<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Rule;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    // ================= GEJALA =================
    public function gejala(){
        $data = Gejala::all();
        return view('admin.gejala', compact('data'));
    }

    public function tambahGejala(Request $r){
        $r->validate([
            'kode' => 'required',
            'nama' => 'required'
        ]);

        Gejala::create($r->all());

        return back()->with('success', 'Gejala berhasil ditambahkan');
    }

    // ================= PENYAKIT =================
    public function penyakit(){
        $data = Penyakit::all();
        return view('admin.penyakit', compact('data'));
    }

    public function tambahPenyakit(Request $r){
        $r->validate([
            'kode' => 'required',
            'nama' => 'required',
            'deskripsi' => 'required'
        ]);

        Penyakit::create($r->all());

        return back()->with('success', 'Penyakit berhasil ditambahkan');
    }

    // ================= RULE =================
    public function rule(){
        $gejala = Gejala::all();
        $penyakit = Penyakit::all();
        $rules = Rule::all();

        return view('admin.rule', compact('gejala','penyakit','rules'));
    }

    public function tambahRule(Request $r){
        $r->validate([
            'penyakit_id' => 'required',
            'gejala_id' => 'required',
            'mb' => 'required|numeric',
            'md' => 'required|numeric'
        ]);

        Rule::create($r->all());

        return back()->with('success', 'Rule berhasil ditambahkan');
    }
}