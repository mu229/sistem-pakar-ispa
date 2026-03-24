@extends('admin.layout')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Administrator</h1>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="border-left: 4px solid #4e73df;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="font-size: 0.8rem;">Total Gejala</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Gejala::count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="border-left: 4px solid #1cc88a;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="font-size: 0.8rem;">Total Penyakit</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Penyakit::count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2" style="border-left: 4px solid #f6c23e;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 0.8rem;">Total Basis Aturan (Rule)</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Rule::count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2" style="border-left: 4px solid #36b9cc;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 0.8rem;">Riwayat Diagnosa</div>
                        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ \App\Models\Riwayat::count() ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-8 mb-4">
        <div class="card shadow mb-4 h-100">
            <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Metode Certainty Factor (CF)</h6>
            </div>
            <div class="card-body">
                <p style="text-align: justify;">
                    <em>Certainty Factor</em> merupakan sebuah metode yang digunakan untuk menghadapi masalah yang tidak memiliki kepastian terhadap jawaban yang diterima oleh seorang pakar. Metode ini digunakan untuk mendeteksi seberapa banyak ukuran kepastian berdasarkan fakta atau aturan yang ditemukan, serta untuk menghitung tingkat akurasi dari setiap penyakit.
                </p>
                <hr>
                <h6 class="font-weight-bold text-dark mt-3">Rumus Perhitungan:</h6>
                <ol class="text-dark">
                    <li class="mb-2">
                        <strong>Rumus CF Pakar pada Setiap Gejala:</strong><br>
                        <code style="font-size: 1rem; color: #e83e8c;">CF(H,E) = MB(H,E) - MD(H,E)</code>
                    </li>
                    <li class="mb-2">
                        <strong>CF dengan Premis Tunggal (Nilai CF Awal):</strong><br>
                        <code style="font-size: 1rem; color: #e83e8c;">CFold(n) = CF(P) * CF(U)</code>
                    </li>
                    <li class="mb-2">
                        <strong>CF Gabungan (Jika terdapat lebih dari satu gejala):</strong><br>
                        <code style="font-size: 1rem; color: #e83e8c;">CFcombine = CFold(n) + CFold(n+1) * (1 - CFold(n))</code>
                    </li>
                    <li class="mb-2">
                        <strong>Persentase Penyakit:</strong><br>
                        <code style="font-size: 1rem; color: #e83e8c;">CFpersentase = CFcombine * 100</code>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card shadow mb-4 h-100">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">Keterangan Variabel</h6>
            </div>
            <div class="card-body" style="font-size: 0.9rem; color: #4a5568;">
                <ul class="list-unstyled">
                    <li class="mb-3 border-bottom pb-2">
                        <strong class="text-dark">CF(H,E)</strong><br>
                        CF dari hipotesis (H) dipengaruhi oleh simptom/gejala (E). Nilai berada dalam rentang 0 (ketidakpercayaan total) hingga 1 (kepercayaan total).
                    </li>
                    <li class="mb-3 border-bottom pb-2">
                        <strong class="text-dark">MB(H,E)</strong><br>
                        <em>Measure of increased Belief</em> (Besaran kenaikan kepercayaan) terhadap hipotesis yang dipengaruhi gejala.
                    </li>
                    <li class="mb-3 border-bottom pb-2">
                        <strong class="text-dark">MD(H,E)</strong><br>
                        <em>Measure of increased Disbelief</em> (Besaran kenaikan ketidakpercayaan) terhadap hipotesis yang dipengaruhi gejala.
                    </li>
                    <li class="mb-3 border-bottom pb-2">
                        <strong class="text-dark">CF(P)</strong><br>
                        Nilai besaran CF dari Pakar.
                    </li>
                    <li class="mb-3 border-bottom pb-2">
                        <strong class="text-dark">CF(U)</strong><br>
                        Nilai besaran CF dari User/Pengguna.
                    </li>
                    <li class="mb-3">
                        <strong class="text-dark">CFold</strong><br>
                        Nilai hasil perkalian CF Pakar dan CF User.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card shadow border-left-info mb-4">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-info">Teknik Inferensi: Forward Chaining</h6>
            </div>
            <div class="card-body">
                <p class="mb-0" style="text-align: justify; color: #4a5568;">
                    <em>Forward Chaining</em> adalah teknik mencari sebuah fakta yang diketahui dan kemudian membandingkannya dengan klausa IF dari aturan IF-THEN. Aturan diterapkan jika fakta ada dan memenuhi bagian IF, maka sebuah fakta baru akan dimasukkan ke dalam database. Arah pencarian penalaran ke depan (runut maju) dimulai dari data menuju tujuan, dari bukti menuju hipotesis, atau dari gejala menuju diagnosa dengan menggunakan logika "OR" dan "AND" untuk menghasilkan sebuah kesimpulan berdasarkan gejala yang dialami oleh pasien.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection