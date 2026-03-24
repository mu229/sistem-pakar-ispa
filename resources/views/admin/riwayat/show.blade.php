@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h4 text-gray-800 mb-0">Detail Perhitungan Matematis</h2>
    <a href="{{ route('riwayat.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm border-left-primary">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pasien: {{ $riwayat->nama_pasien }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Hasil: {{ $riwayat->nama_penyakit }} <span class="text-success">({{ $riwayat->persentase }}%)</span>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Perhitungan Certainty Factor (Sesuai Jurnal)</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center">Gejala</th>
                                <th class="text-center">MB-MD (CF1)</th>
                                <th class="text-center">CF User (CF2)</th>
                                <th class="text-center">CFold (CF1 * CF2)</th>
                                <th class="text-center">CFCombined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($langkah as $l)
                            <tr>
                                <td class="text-center">{{ $l['kode_gejala'] }}</td>
                                <td class="text-center">{{ $l['cf1'] }}</td>
                                <td class="text-center">{{ $l['cf2'] }}</td>
                                <td class="text-center">{{ $l['cf_old'] }}</td>
                                <td class="text-center fw-bold text-primary">{{ $l['cf_combine'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Penjabaran Rumus Manual</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($langkah as $index => $l)
                    <div class="col-md-6 mb-3">
                        <div class="p-3 bg-light border rounded">
                            <strong class="text-primary d-block mb-2">Langkah {{ $index + 1 }} (Gejala {{ $l['kode_gejala'] }})</strong>
                            <pre class="m-0" style="font-family: monospace; font-size: 14px;">{{ $l['teks_rumus'] }}</pre>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="alert alert-success mt-3 mb-0">
                    <h6 class="alert-heading fw-bold">Kesimpulan Akhir:</h6>
                    <p class="mb-0">Nilai CF Combine Terakhir = <strong>{{ end($langkah)['cf_combine'] }}</strong></p>
                    <hr>
                    <p class="mb-0">Persentase Penyakit = {{ end($langkah)['cf_combine'] }} * 100 = <strong>{{ $riwayat->persentase }}%</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection