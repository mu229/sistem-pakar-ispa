<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\RuleController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

// ================= USER =================
// Rute untuk menampilkan halaman depan (Form Diagnosa)
Route::get('/', [DiagnosaController::class, 'index'])->name('diagnosa.index');

// Rute untuk memproses form saat disubmit
Route::post('/proses', [DiagnosaController::class, 'proses'])->name('diagnosa.proses');


// ================= AUTH (BREEZE) =================
Route::get('/dashboard', function () {
    return redirect('/admin');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ================= ADMIN DASHBOARD =================
   Route::get('/admin', [AdminController::class,'dashboard'])->name('admin.dashboard');

    // ================= CRUD GEJALA =================
    Route::get('/admin/gejala', [GejalaController::class, 'index'])->name('gejala.index');
    Route::get('/admin/gejala/create', [GejalaController::class, 'create'])->name('gejala.create');
    Route::post('/admin/gejala', [GejalaController::class, 'store'])->name('gejala.store');
    Route::get('/admin/gejala/{id}/edit', [GejalaController::class, 'edit'])->name('gejala.edit');
    Route::put('/admin/gejala/{id}', [GejalaController::class, 'update'])->name('gejala.update');
    Route::delete('/admin/gejala/{id}', [GejalaController::class, 'destroy'])->name('gejala.destroy');
    
    // ================= CRUD PENYAKIT =================
    Route::get('/admin/penyakit', [PenyakitController::class, 'index'])->name('penyakit.index');
    Route::get('/admin/penyakit/create', [PenyakitController::class, 'create'])->name('penyakit.create');
    Route::post('/admin/penyakit', [PenyakitController::class, 'store'])->name('penyakit.store');
    Route::get('/admin/penyakit/{id}/edit', [PenyakitController::class, 'edit'])->name('penyakit.edit');
    Route::put('/admin/penyakit/{id}', [PenyakitController::class, 'update'])->name('penyakit.update');
    Route::delete('/admin/penyakit/{id}', [PenyakitController::class, 'destroy'])->name('penyakit.destroy');

    // ================= CRUD RULE =================
    Route::get('/admin/rule', [RuleController::class, 'index'])->name('rule.index');
    Route::get('/admin/rule/create', [RuleController::class, 'create'])->name('rule.create');
    Route::post('/admin/rule', [RuleController::class, 'store'])->name('rule.store');
    Route::get('/admin/rule/{id}/edit', [RuleController::class, 'edit'])->name('rule.edit');
    Route::put('/admin/rule/{id}', [RuleController::class, 'update'])->name('rule.update');
    Route::delete('/admin/rule/{id}', [RuleController::class, 'destroy'])->name('rule.destroy');

    // ================= RIWAYAT DIAGNOSA (ADMIN ONLY) =================
    Route::get('/admin/riwayat', [App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/admin/riwayat/{id}', [App\Http\Controllers\RiwayatController::class, 'show'])->name('riwayat.show');
});

require __DIR__.'/auth.php';