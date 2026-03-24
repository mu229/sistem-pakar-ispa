<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Pakar ISPA</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{
  --blue:#2563eb;
  --blue-mid:#3b82f6;
  --blue-light:#93c5fd;
  --blue-pale:#dbeafe;
  --blue-bg:#eff6ff;
  --white:#fff;
  --navy:#1e3a5f;
  --muted:#64748b;
  --border:#bfdbfe;
}
html{scroll-behavior:smooth}
body{
  font-family:system-ui,-apple-system,'Segoe UI',sans-serif;
  background:var(--blue-bg);
  color:#1e293b;
  min-height:100vh;
}
nav{
  position:sticky;top:0;z-index:99;
  background:rgba(255,255,255,.88);
  backdrop-filter:blur(12px);
  border-bottom:1px solid var(--border);
  padding:14px 6%;
  display:flex;align-items:center;justify-content:space-between;
}
.brand{display:flex;align-items:center;gap:9px;text-decoration:none}
.brand-icon{
  width:34px;height:34px;
  background:linear-gradient(135deg,var(--blue),var(--blue-mid));
  border-radius:9px;display:grid;place-items:center;font-size:1rem;
  box-shadow:0 4px 12px rgba(37,99,235,.22);
}
.brand-text{font-size:1rem;font-weight:700;color:var(--navy)}
.btn-login{
  background:var(--navy);color:#fff;border:none;border-radius:50px;
  padding:8px 22px;font-size:.82rem;cursor:pointer;text-decoration:none;
}
main{
  max-width:900px;margin:0 auto;padding:40px 20px 80px;
}
.hero{text-align:center;margin-bottom:40px}
h1{
  font-size:clamp(1.8rem,4vw,2.8rem);font-weight:800;
  color:var(--navy);line-height:1.2;margin-bottom:14px;
}
h1 em{
  font-style:normal;
  background:linear-gradient(90deg,var(--blue),#38bdf8);
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;
}
.hero-sub{color:var(--muted);font-size:.93rem;max-width:500px;margin:0 auto;line-height:1.7;}

/* ================= EDUKASI & CAROUSEL SECTION ================= */
.info-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 18px;
  padding: 30px;
  margin-bottom: 30px;
  box-shadow: 0 4px 20px rgba(37,99,235,.06);
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
  align-items: center;
}
.info-text h2 {
  color: var(--navy);
  margin-bottom: 12px;
  font-size: 1.4rem;
}
.info-text p {
  color: var(--muted);
  line-height: 1.6;
  margin-bottom: 12px;
  font-size: 0.9rem;
  text-align: justify;
}
.info-text ul {
  padding-left: 20px;
  color: var(--muted);
  font-size: 0.9rem;
}
.info-text li {
  margin-bottom: 6px;
}
.carousel-container {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  height: 280px;
}
.carousel-slide {
  display: none;
  width: 100%;
  height: 100%;
  object-fit: cover;
  animation: fade 0.8s ease-in-out;
}
.carousel-slide.active { display: block; }
@keyframes fade {
  from {opacity: 0.6; transform: scale(1.02);}
  to {opacity: 1; transform: scale(1);}
}
.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.7);
  border: none;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  cursor: pointer;
  font-size: 1.2rem;
  font-weight: bold;
  color: var(--navy);
  transition: all 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
}
.carousel-btn:hover { background: white; box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
.prev-btn { left: 10px; }
.next-btn { right: 10px; }

/* ================= DIAGNOSA FORM SECTION ================= */
.card{
  background:var(--white);border:1px solid var(--border);border-radius:18px;
  padding:36px 40px;margin-bottom:26px;
  box-shadow:0 2px 14px rgba(37,99,235,.06);
}
.form-title{font-size:1.1rem;font-weight:700;color:var(--navy);margin-bottom:6px}
.form-sub{font-size:.83rem;color:var(--muted);margin-bottom:22px}
.field-label{
  display:block;font-size:.74rem;font-weight:600;
  letter-spacing:.5px;text-transform:uppercase;color:var(--muted);margin-bottom:8px;
}
.input{
  width:100%;background:var(--blue-bg);border:1px solid var(--border);
  border-radius:9px;padding:11px 14px;font-size:.9rem;font-family:inherit;color:#1e293b;
}
.gejala-list{display:flex;flex-direction:column;gap:12px;}
.gejala-item{
  display:flex;justify-content:space-between;align-items:center;
  background:var(--blue-bg);border:1px solid var(--border);
  padding:12px 16px;border-radius:10px;
}
.gejala-text{font-size:.9rem;color:var(--navy);font-weight:500;}
.gejala-select{
  padding:8px 12px;border-radius:6px;border:1px solid var(--blue-light);
  background:#fff;font-size:.85rem;color:var(--navy);width:200px;
}
.btn-submit{
  width:100%;margin-top:28px;
  background:linear-gradient(135deg,var(--blue),#38bdf8);
  color:#fff;border:none;border-radius:11px;padding:14px;
  font-size:.93rem;font-weight:700;cursor:pointer;
  box-shadow:0 4px 16px rgba(37,99,235,.25);
}
@media(max-width:768px){
  .info-card { grid-template-columns: 1fr; padding: 20px;}
  .carousel-container { height: 220px; }
  .card{padding:22px 16px}
  .gejala-item{flex-direction:column;align-items:flex-start;gap:10px;}
  .gejala-select{width:100%;}
}
</style>
</head>
<body>

<nav>
  <a class="brand" href="/">
    <div class="brand-icon">⚕️</div>
    <span class="brand-text">SISTEM PAKAR ISPA</span>
  </a>
  <a href="/login" class="btn-login">Login Admin</a>
</nav>

<main>
  <div class="hero">
    <h1>Sistem Pakar<br><em>Diagnosis ISPA</em></h1>
    <p class="hero-sub">Kenali gejalanya, deteksi lebih awal. Gunakan kecerdasan buatan untuk mengukur tingkat keparahan ISPA secara mandiri.</p>
  </div>

  <div class="info-card">
    <div class="carousel-container">
      <img src="https://images.unsplash.com/photo-1584036561566-baf8f5f1b144?auto=format&fit=crop&w=600&q=80" class="carousel-slide active" alt="Pencegahan ISPA">
      <img src="{{ asset('images/dokter.png') }}" class="carousel-slide" alt="Sistem Pernapasan Paru-paru">
      <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?auto=format&fit=crop&w=600&q=80" class="carousel-slide" alt="Sistem Pernapasan Paru-paru">
      
      <button class="carousel-btn prev-btn" onclick="changeSlide(-1)">&#10094;</button>
      <button class="carousel-btn next-btn" onclick="changeSlide(1)">&#10095;</button>
    </div>
    <div class="info-text">
      <h2>Mengenal ISPA</h2>
      <p><strong>Infeksi Saluran Pernapasan Akut (ISPA)</strong> adalah peradangan yang terjadi pada saluran pernapasan, baik bagian atas maupun bawah. Penyakit ini sangat mudah menular dan sering dipicu oleh virus atau bakteri di lingkungan sekitar.</p>
      <p>Jika dibiarkan, ISPA dapat menyebar ke seluruh sistem pernapasan dan menyebabkan komplikasi serius seperti pneumonia.</p>
      <p><strong>Beberapa gejala umum meliputi:</strong></p>
      <ul>
        <li>Batuk (kering maupun berdahak)</li>
        <li>Demam ringan hingga tinggi</li>
        <li>Hidung tersumbat dan nyeri tenggorokan</li>
        <li>Sesak napas atau dada terasa berat</li>
      </ul>
    </div>
  </div>
  <div class="card">
    <p class="form-title">📋 Formulir Diagnosis</p>
    <p class="form-sub">Masukkan nama dan pilih tingkat keparahan gejala yang Anda rasakan saat ini.</p>

    <form method="POST" action="/proses">
      @csrf
      <div style="margin-bottom:24px">
        <label class="field-label" for="nama">Nama Pengguna</label>
        <input class="input" type="text" id="nama" name="nama" placeholder="Masukkan nama Anda..." required>
      </div>

      <label class="field-label">Pilih Gejala & Tingkat Keyakinan</label>
      <div class="gejala-list">
        @foreach($gejala as $g)
        <div class="gejala-item">
          <span class="gejala-text">{{ $g->kode }} - {{ $g->nama }}</span>
          <select name="gejala[{{ $g->id }}]" class="gejala-select">
            <option value="0">Tidak Mengalami (0.0)</option>
            <option value="0.2">Tidak Tahu / Ragu (0.2)</option>
            <option value="0.4">Sedikit Yakin (0.4)</option>
            <option value="0.6">Cukup Yakin (0.6)</option>
            <option value="0.8">Yakin (0.8)</option>
            <option value="1.0">Sangat Yakin (1.0)</option>
          </select>
        </div>
        @endforeach
      </div>

      <button type="submit" class="btn-submit">⚕️ Proses Diagnosa Sekarang</button>
    </form>
  </div>
</main>

<script>
  // Logika Javascript untuk Carousel Gambar
  let slideIndex = 0;
  const slides = document.querySelectorAll('.carousel-slide');
  let autoSlideInterval;

  function showSlide(n) {
    slides.forEach(slide => slide.classList.remove('active'));
    slideIndex = (n + slides.length) % slides.length;
    slides[slideIndex].classList.add('active');
  }

  function changeSlide(n) {
    showSlide(slideIndex + n);
    resetInterval(); // Reset timer saat diklik manual
  }

  function startInterval() {
    autoSlideInterval = setInterval(() => {
      changeSlide(1);
    }, 4000); // Ganti gambar otomatis setiap 4 detik
  }

  function resetInterval() {
    clearInterval(autoSlideInterval);
    startInterval();
  }

  // Mulai slideshow saat halaman dimuat
  startInterval();
</script>

</body>
</html>