@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 text-gray-800 mb-0">Edit Data Penyakit</h2>
    <a href="{{ route('penyakit.index') }}" class="btn btn-secondary">Kembali</a>
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
        <form action="{{ route('penyakit.update', $penyakit->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="kode" class="form-label">Kode Penyakit</label>
                <input type="text" name="kode" id="kode" class="form-control" value="{{ $penyakit->kode }}" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Penyakit</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $penyakit->nama }}" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi / Penjelasan Singkat</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required>{{ $penyakit->deskripsi }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
    </div>
</div>

@endsection