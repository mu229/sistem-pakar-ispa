{{-- ============================================================ --}}
{{-- CREATE: resources/views/admin/gejala/create.blade.php --}}
{{-- ============================================================ --}}
@extends('admin.layout')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .form-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 2rem 0;
        max-width: 640px;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        letter-spacing: -0.4px;
        margin: 0;
    }

    .page-title span {
        display: block;
        font-size: 0.78rem;
        font-weight: 500;
        color: #94a3b8;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 2px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 18px;
        background: #f8fafc;
        color: #475569;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-back:hover {
        background: #f1f5f9;
        color: #1e293b;
        border-color: #cbd5e1;
        text-decoration: none;
    }

    .alert-error-custom {
        background: #fff1f2;
        border: 1px solid #fecdd3;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 1.5rem;
    }

    .alert-error-custom .err-title {
        font-size: 0.8rem;
        font-weight: 700;
        color: #be123c;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .alert-error-custom ul {
        margin: 0;
        padding-left: 1.2rem;
    }

    .alert-error-custom ul li {
        font-size: 0.8rem;
        color: #9f1239;
        margin-bottom: 2px;
    }

    .form-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 2rem;
    }

    .form-section-title {
        font-size: 0.72rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 1.5rem;
        padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }

    .field-group {
        margin-bottom: 1.25rem;
    }

    .field-label {
        display: block;
        font-size: 0.82rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .field-label .required {
        color: #f43f5e;
        margin-left: 2px;
    }

    .field-hint {
        font-size: 0.72rem;
        color: #94a3b8;
        margin-top: 5px;
    }

    .form-control-custom {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.875rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0f172a;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #fff;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        border-color: #0f172a;
        box-shadow: 0 0 0 3px rgba(15,23,42,0.07);
    }

    .form-control-custom::placeholder {
        color: #cbd5e1;
    }

    .form-control-custom.is-invalid {
        border-color: #fda4af;
        background: #fff1f2;
    }

    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 1rem;
        border-top: 1px solid #f1f5f9;
        margin-top: 1.5rem;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 24px;
        background: #0f172a;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-submit:hover {
        background: #1e293b;
        transform: translateY(-1px);
        box-shadow: 0 4px 14px rgba(15,23,42,0.18);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        padding: 11px 20px;
        background: transparent;
        color: #64748b;
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .btn-cancel:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
        color: #374151;
        text-decoration: none;
    }
</style>

<div class="form-wrap">

    <div class="page-header">
        <h2 class="page-title">
            <span>Master Data / Gejala</span>
            Tambah Gejala Baru
        </h2>
        <a href="{{ route('gejala.index') }}" class="btn-back">
            <i class="fas fa-arrow-left" style="font-size:0.75rem;"></i> Kembali
        </a>
    </div>

    @if($errors->any())
    <div class="alert-error-custom">
        <div class="err-title"><i class="fas fa-exclamation-circle"></i> Terdapat kesalahan input</div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="form-card">
        <div class="form-section-title">Informasi Gejala</div>

        <form action="{{ route('gejala.store') }}" method="POST">
            @csrf

            <div class="field-group">
                <label for="kode" class="field-label">
                    Kode Gejala <span class="required">*</span>
                </label>
                <input
                    type="text"
                    name="kode"
                    id="kode"
                    class="form-control-custom {{ $errors->has('kode') ? 'is-invalid' : '' }}"
                    value="{{ old('kode') }}"
                    placeholder="Contoh: G001"
                    required
                >
                <div class="field-hint">Kode unik untuk mengidentifikasi gejala ini.</div>
            </div>

            <div class="field-group">
                <label for="nama" class="field-label">
                    Nama Gejala <span class="required">*</span>
                </label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="form-control-custom {{ $errors->has('nama') ? 'is-invalid' : '' }}"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama gejala..."
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save" style="font-size:0.8rem;"></i>
                    Simpan Data
                </button>
                <a href="{{ route('gejala.index') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection