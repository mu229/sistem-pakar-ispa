@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 text-gray-800 mb-0">Tambah Data Rule</h2>
    <a href="{{ route('rule.index') }}" class="btn btn-secondary">Kembali</a>
</div>

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('rule.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="penyakit_id" class="form-label">Pilih Penyakit</label>
                    <select name="penyakit_id" id="penyakit_id" class="form-select" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach($penyakit as $p)
                            <option value="{{ $p->id }}" {{ old('penyakit_id') == $p->id ? 'selected' : '' }}>{{ $p->kode }} - {{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="gejala_id" class="form-label">Pilih Gejala</label>
                    <select name="gejala_id" id="gejala_id" class="form-select" required>
                        <option value="">-- Pilih Gejala --</option>
                        @foreach($gejala as $g)
                            <option value="{{ $g->id }}" {{ old('gejala_id') == $g->id ? 'selected' : '' }}>{{ $g->kode }} - {{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="mb" class="form-label">Measure of Belief (MB)</label>
                    <input type="number" step="0.1" min="0" max="1" name="mb" id="mb" class="form-control" value="{{ old('mb') }}" placeholder="Contoh: 0.8" required>
                    <small class="text-muted">Nilai kepastian (0.0 sampai 1.0)</small>
                </div>
                <div class="col-md-6">
                    <label for="md" class="form-label">Measure of Disbelief (MD)</label>
                    <input type="number" step="0.1" min="0" max="1" name="md" id="md" class="form-control" value="{{ old('md') }}" placeholder="Contoh: 0.2" required>
                    <small class="text-muted">Nilai ketidakpastian (0.0 sampai 1.0)</small>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Simpan Rule</button>
        </form>
    </div>
</div>

@endsection