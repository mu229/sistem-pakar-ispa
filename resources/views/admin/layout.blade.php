<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel - ISPA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
  --blue:        #2563eb;
  --blue-mid:    #3b82f6;
  --blue-light:  #93c5fd;
  --blue-pale:   #dbeafe;
  --blue-bg:     #eff6ff;
  --blue-soft:   #bfdbfe;
  --navy:        #0f2044;
  --border:      #dbeafe;
  --muted:       #64748b;
  --white:       #ffffff;
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
  background: #f0f6ff;
  color: #1e293b;
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

/* ══════════════════════════════════════
   TOP HEADER BAR
══════════════════════════════════════ */
.top-header {
  background: var(--navy);
  padding: 0 32px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 2px 20px rgba(15,32,68,.35);
}

.header-brand {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
}
.brand-icon {
  width: 36px; height: 36px;
  background: linear-gradient(135deg, #2563eb, #38bdf8);
  border-radius: 10px;
  display: grid; place-items: center;
  font-size: 1rem;
  box-shadow: 0 3px 12px rgba(37,99,235,.45);
  flex-shrink: 0;
}
.brand-text {
  font-size: .95rem;
  font-weight: 800;
  color: #fff;
  letter-spacing: .3px;
  line-height: 1.1;
}
.brand-sub {
  font-size: .65rem;
  color: #7ea8d4;
  font-weight: 400;
}

.header-right {
  display: flex;
  align-items: center;
  gap: 10px;
}

.date-chip {
  background: rgba(191,219,254,.1);
  border: 1px solid rgba(191,219,254,.2);
  border-radius: 8px;
  padding: 6px 12px;
  font-size: .72rem;
  color: #bfdbfe;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 6px;
}

.notif-btn {
  width: 36px; height: 36px;
  background: rgba(191,219,254,.08);
  border: 1px solid rgba(191,219,254,.15);
  border-radius: 9px;
  display: grid; place-items: center;
  color: #bfdbfe;
  font-size: .82rem;
  cursor: pointer;
  transition: background .2s;
  position: relative;
  text-decoration: none;
}
.notif-btn:hover { background: rgba(191,219,254,.18); }
.notif-dot {
  position: absolute; top: 7px; right: 7px;
  width: 7px; height: 7px;
  background: #ef4444;
  border-radius: 50%;
  border: 2px solid var(--navy);
}

.user-chip {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(191,219,254,.08);
  border: 1px solid rgba(191,219,254,.15);
  border-radius: 9px;
  padding: 5px 12px 5px 6px;
  cursor: pointer;
  transition: background .2s;
}
.user-chip:hover { background: rgba(191,219,254,.18); }
.user-avatar {
  width: 28px; height: 28px;
  background: linear-gradient(135deg, #2563eb, #38bdf8);
  border-radius: 50%;
  display: grid; place-items: center;
  font-size: .7rem;
  color: #fff;
  font-weight: 800;
}
.user-info-name { font-size: .76rem; font-weight: 700; color: #fff; line-height: 1.2; }
.user-info-role { font-size: .62rem; color: #7ea8d4; }

.btn-logout {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 7px 14px;
  background: rgba(239,68,68,.12);
  border: 1px solid rgba(239,68,68,.25);
  border-radius: 9px;
  color: #fca5a5;
  font-size: .76rem;
  font-weight: 700;
  font-family: inherit;
  cursor: pointer;
  transition: background .2s, color .2s, transform .15s;
  text-decoration: none;
}
.btn-logout:hover {
  background: rgba(239,68,68,.28);
  color: #fff;
  transform: translateY(-1px);
}

/* ══════════════════════════════════════
   NAVBAR (Tab menu)
══════════════════════════════════════ */
.nav-bar {
  background: var(--white);
  border-bottom: 1px solid var(--border);
  padding: 0 32px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 4px;
  position: sticky;
  top: 60px;
  z-index: 90;
  box-shadow: 0 2px 12px rgba(37,99,235,.06);
}

.nav-tabs-custom {
  display: flex;
  align-items: center;
  gap: 2px;
  overflow-x: auto;
  scrollbar-width: none;
  -ms-overflow-style: none;
}
.nav-tabs-custom::-webkit-scrollbar { display: none; }

.nav-tab {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 0 18px;
  height: 52px;
  color: var(--muted);
  font-size: .82rem;
  font-weight: 600;
  text-decoration: none;
  border-bottom: 3px solid transparent;
  white-space: nowrap;
  transition: color .2s, border-color .2s, background .2s;
  position: relative;
}
.nav-tab .tab-icon {
  width: 26px; height: 26px;
  border-radius: 7px;
  display: grid; place-items: center;
  font-size: .72rem;
  background: #f1f5f9;
  transition: background .2s, color .2s;
}
.nav-tab:hover {
  color: var(--blue);
  background: var(--blue-bg);
}
.nav-tab:hover .tab-icon {
  background: var(--blue-pale);
  color: var(--blue);
}
.nav-tab.active {
  color: var(--blue);
  border-bottom-color: var(--blue);
  background: var(--blue-bg);
}
.nav-tab.active .tab-icon {
  background: var(--blue-pale);
  color: var(--blue);
}

/* Page breadcrumb inside navbar */
.nav-breadcrumb {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: .75rem;
  color: var(--muted);
  white-space: nowrap;
  padding: 0 4px;
}
.nav-breadcrumb .page-title {
  font-weight: 700;
  color: var(--navy);
  font-size: .82rem;
}
.nav-breadcrumb .sep { color: #cbd5e1; }

/* ══════════════════════════════════════
   MAIN CONTENT
══════════════════════════════════════ */
.main-content {
  flex: 1;
  padding: 28px 32px 40px;
  position: relative;
}

/* Subtle background glow */
.main-content::before {
  content: '';
  position: fixed;
  top: 0; right: 0;
  width: 55%; height: 45%;
  background: radial-gradient(ellipse 520px 360px at 85% 8%, rgba(147,197,253,.15) 0%, transparent 70%);
  pointer-events: none;
  z-index: 0;
}
.main-content > * { position: relative; z-index: 1; }

/* ══════════════════════════════════════
   ANIMATIONS
══════════════════════════════════════ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(14px); }
  to   { opacity: 1; transform: translateY(0); }
}
.main-content > * { animation: fadeUp .38s ease both; }

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media (max-width: 768px) {
  .top-header { padding: 0 16px; }
  .nav-bar     { padding: 0 16px; }
  .main-content { padding: 16px; }
  .brand-sub { display: none; }
  .date-chip { display: none; }
  .user-info-role { display: none; }
}
@media (max-width: 480px) {
  .header-right .user-chip .user-info-name { display: none; }
}
</style>
</head>
<body>

<!-- ─── Top Header ─── -->
<header class="top-header">

  <a href="{{ route('admin.dashboard') }}" class="header-brand">
    <div class="brand-icon">⚕️</div>
    <div>
      <div class="brand-text">Admin ISPA</div>
      <div class="brand-sub">Kelola Data Sistem Pakar</div>
    </div>
  </a>

  <div class="header-right">
    <div class="date-chip">
      <i class="fas fa-calendar-alt"></i>
      <span id="topbar-date"></span>
    </div>

    <a class="notif-btn">
      <i class="fas fa-bell"></i>
      <span class="notif-dot"></span>
    </a>

    <div class="user-chip">
      <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
      <div>
        <div class="user-info-name">{{ auth()->user()->name ?? 'Administrator' }}</div>
        <div class="user-info-role">{{ auth()->user()->role ?? 'Super Admin' }}</div>
      </div>
    </div>

    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </button>
    </form>
  </div>

</header>

<!-- ─── Navigation Tabs ─── -->
<nav class="nav-bar">

  <div class="nav-tabs-custom">
    <a href="{{ route('admin.dashboard') }}" class="nav-tab">
      <div class="tab-icon"><i class="fas fa-home"></i></div>
      Dashboard
    </a>
    <a href="{{ route('penyakit.index') }}" class="nav-tab">
      <div class="tab-icon"><i class="fas fa-viruses"></i></div>
      Data Penyakit
    </a>
    <a href="{{ route('gejala.index') }}" class="nav-tab">
      <div class="tab-icon"><i class="fas fa-stethoscope"></i></div>
      Data Gejala
    </a>
    <a href="{{ route('rule.index') }}" class="nav-tab">
      <div class="tab-icon"><i class="fas fa-cogs"></i></div>
      Aturan Dan C&F
    </a>
    <a href="{{ route('riwayat.index') }}" class="nav-tab">
      <div class="tab-icon"><i class="fas fa-history"></i></div>
      Riwayat Diagnosis
    </a>
  </div>

  <div class="nav-breadcrumb">
    <span class="page-title">@yield('page_title', 'Dashboard')</span>
    <span class="sep">/</span>
    <span>@yield('page_subtitle', 'Admin Panel')</span>
  </div>

</nav>

<!-- ─── Main Content ─── -->
<main class="main-content">
  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ── Topbar date
const d = new Date();
document.getElementById('topbar-date').textContent =
  d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });

// ── Active nav tab
const path = window.location.pathname;
document.querySelectorAll('.nav-tab').forEach(a => {
  const href = a.getAttribute('href');
  if (href && path.startsWith(href) && href !== '/') {
    a.classList.add('active');
  } else if (href === '/' && path === '/') {
    a.classList.add('active');
  }
});
</script>
</body>
</html>