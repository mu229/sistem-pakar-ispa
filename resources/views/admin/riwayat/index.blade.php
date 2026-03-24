@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 text-gray-800 mb-0">Data Riwayat Diagnosa</h2>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th width="20%">Nama Pasien</th>
                        <th width="25%">Hasil Diagnosa</th>
                        <th width="15%" class="text-center">Kepastian</th>
                        <th width="20%">Tanggal</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $index => $r)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="fw-bold text-primary">{{ $r->nama_pasien }}</td>
                        <td>{{ $r->nama_penyakit }}</td>
                        <td class="text-center">
                            <span class="badge bg-success" style="font-size: 0.9rem;">{{ $r->persentase }}%</span>
                        </td>
                        <td>{{ $r->created_at->format('d M Y, H:i') }}</td>
                        <td class="text-center">
                            <a href="{{ route('riwayat.show', $r->id) }}" class="btn btn-sm btn-info text-white" title="Lihat Perhitungan">
                                <i class="fas fa-calculator me-1"></i> Cek Hitungan
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data riwayat diagnosa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection