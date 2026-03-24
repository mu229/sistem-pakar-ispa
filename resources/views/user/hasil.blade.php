<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Hasil Diagnosis ISPA</title>
<style>
/* ... (Gunakan CSS yang sama persis dengan form di atas) ... */
*{box-sizing:border-box;margin:0;padding:0}
:root{ --blue:#2563eb; --blue-mid:#3b82f6; --blue-light:#93c5fd; --blue-bg:#eff6ff; --white:#fff; --navy:#1e3a5f; --muted:#64748b; --border:#bfdbfe;}
body{font-family:system-ui,-apple-system,sans-serif; background:var(--blue-bg); color:#1e293b; min-height:100vh;}
nav{position:sticky;top:0;z-index:99; background:rgba(255,255,255,.88); border-bottom:1px solid var(--border); padding:14px 6%; display:flex; align-items:center; justify-content:space-between;}
.brand{display:flex;align-items:center;gap:9px;text-decoration:none}
.brand-icon{width:34px;height:34px;background:linear-gradient(135deg,var(--blue),var(--blue-mid));border-radius:9px;display:grid;place-items:center;font-size:1rem;color:#fff;}
.brand-text{font-size:1rem;font-weight:700;color:var(--navy)}
main{max-width:800px;margin:0 auto;padding:40px 20px;}
.card{background:var(--white);border:1px solid var(--border);border-radius:18px;padding:36px;box-shadow:0 4px 20px rgba(37,99,235,.08);margin-bottom:24px;}
.result-header{text-align:center;margin-bottom:30px;padding-bottom:20px;border-bottom:1px dashed var(--border);}
.result-header h2{color:var(--navy);font-size:1.5rem;margin-bottom:8px;}
.result-header p{color:var(--muted);font-size:.95rem;}
.highlight-box{background:linear-gradient(135deg,var(--blue),#38bdf8);border-radius:14px;padding:30px;text-align:center;color:#fff;margin-bottom:30px;}
.highlight-title{font-size:1rem;opacity:0.9;margin-bottom:10px;text-transform:uppercase;letter-spacing:1px;}
.highlight-disease{font-size:2.5rem;font-weight:800;margin-bottom:5px;}
.highlight-percentage{font-size:1.2rem;background:rgba(255,255,255,0.2);padding:5px 15px;border-radius:20px;display:inline-block;margin-top:10px;}
.other-results{list-style:none;}
.other-results li{display:flex;justify-content:space-between;padding:12px 15px;border-bottom:1px solid var(--blue-bg);font-size:.95rem;}
.other-results li:last-child{border-bottom:none;}
.btn-back{display:block;text-align:center;background:var(--blue-bg);color:var(--blue);text-decoration:none;padding:12px;border-radius:10px;font-weight:600;margin-top:20px;border:1px solid var(--blue-light);}
</style>
</head>
<body>

<nav>
  <a class="brand" href="/">
    <div class="brand-icon">⚕️</div>
    <span class="brand-text">SISTEM PAKAR ISPA</span>
  </a>
</nav>

<main>
  <div class="card">
    <div class="result-header">
      <h2>Hasil Analisis Certainty Factor</h2>
      <p>Diagnosis untuk pasien: <strong>{{ $nama_pasien ?? 'Pasien' }}</strong></p>
    </div>

    @if(count($hasil_diagnosa) > 0)
        <div class="highlight-box">
            <div class="highlight-title">Kemungkinan Terbesar Mengalami</div>
            <div class="highlight-disease">{{ $hasil_diagnosa[0]['nama_penyakit'] }}</div>
            <div class="highlight-percentage">Tingkat Kepastian: {{ $hasil_diagnosa[0]['persentase'] }}%</div>
        </div>

        <h3 style="color:var(--navy);font-size:1.1rem;margin-bottom:15px;">Kemungkinan Penyakit Lainnya:</h3>
        <ul class="other-results">
            @foreach($hasil_diagnosa as $index => $hasil)
                @if($index > 0 && $hasil['persentase'] > 0)
                <li>
                    <span>{{ $hasil['nama_penyakit'] }}</span>
                    <strong>{{ $hasil['persentase'] }}%</strong>
                </li>
                @endif
            @endforeach
        </ul>
    @else
        <div style="text-align:center; color:var(--muted); padding:30px;">
            <p>Tidak ada gejala yang dipilih atau tidak ada penyakit yang cocok dengan gejala yang dialami.</p>
        </div>
    @endif

    <a href="/" class="btn-back">← Lakukan Diagnosa Ulang</a>
  </div>
</main>

</body>
</html>