@extends('admin.layout')

@section('content')

<h2 class="mb-4">Data Rule</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $e)
        <div>{{ $e }}</div>
    @endforeach
</div>
@endif

<div class="card p-3 mb-4">
    <form method="POST">
        @csrf

        <div class="row">
            <div class="col-md-3">
                <select name="penyakit_id" class="form-control">
                    <option value="">Pilih Penyakit</option>
                    @foreach($penyakit as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="gejala_id" class="form-control">
                    <option value="">Pilih Gejala</option>
                    @foreach($gejala as $g)
                        <option value="{{ $g->id }}">{{ $g->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input name="mb" class="form-control" placeholder="MB">
            </div>

            <div class="col-md-2">
                <input name="md" class="form-control" placeholder="MD">
            </div>

            <div class="col-md-2">
                <button class="btn btn-success w-100">Tambah</button>
            </div>
        </div>

    </form>
</div>

<div class="card p-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Penyakit</th>
                <th>Gejala</th>
                <th>MB</th>
                <th>MD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rules as $r)
            <tr>
                <td>{{ \App\Models\Penyakit::find($r->penyakit_id)->nama }}</td>
                <td>{{ \App\Models\Gejala::find($r->gejala_id)->nama }}</td>
                <td>{{ $r->mb }}</td>
                <td>{{ $r->md }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection