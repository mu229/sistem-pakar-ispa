@extends('admin.layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 text-gray-800 mb-0">Basis Pengetahuan (Data Rule)</h2>
    <a href="{{ route('rule.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Rule
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">Nama Penyakit</th>
                        <th width="30%">Gejala</th>
                        <th width="10%" class="text-center">MB</th>
                        <th width="10%" class="text-center">MD</th>
                        <th width="10%" class="text-center">CF Pakar</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $r)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold text-primary">{{ \App\Models\Penyakit::find($r->penyakit_id)->nama ?? 'Data Terhapus' }}</td>
                        <td>{{ \App\Models\Gejala::find($r->gejala_id)->nama ?? 'Data Terhapus' }}</td>
                        <td class="text-center"><span class="badge bg-success">{{ $r->mb }}</span></td>
                        <td class="text-center"><span class="badge bg-danger">{{ $r->md }}</span></td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">{{ $r->mb - $r->md }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('rule.edit', $r->id) }}" class="btn btn-sm btn-warning text-white" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('rule.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus rule ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada data rule.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection