@extends('admin.layout')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap');

    :root {
        --blue-50: #eff6ff;
        --blue-100: #dbeafe;
        --blue-200: #bfdbfe;
        --blue-400: #60a5fa;
        --blue-500: #3b82f6;
        --blue-600: #2563eb;
        --blue-700: #1d4ed8;
        --blue-800: #1e3a8a;
        --navy: #0f2044;
        --slate-50: #f8fafc;
        --slate-100: #f1f5f9;
        --slate-200: #e2e8f0;
        --slate-300: #cbd5e1;
        --slate-400: #94a3b8;
        --slate-500: #64748b;
        --slate-600: #475569;
        --slate-700: #334155;
        --slate-800: #1e293b;
    }

    * { box-sizing: border-box; }

    .penyakit-wrap {
        font-family: 'Plus Jakarta Sans', sans-serif;
        padding: 2rem 0 3rem;
        min-height: 100%;
    }

    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 1.75rem;
    }

    .page-breadcrumb {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--slate-400);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 6px;
    }
    .page-breadcrumb i { font-size: 0.55rem; color: var(--blue-400); }

    .page-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--navy);
        letter-spacing: -0.6px;
        margin: 0;
        line-height: 1.1;
    }
    .page-title .accent { color: var(--blue-600); }

    .page-subtitle {
        font-size: 0.79rem;
        color: var(--slate-400);
        margin-top: 5px;
        font-weight: 400;
    }

    /* ── TAMBAH BUTTON ── */
    .btn-tambah {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        padding: 11px 22px;
        background: linear-gradient(135deg, var(--blue-600) 0%, var(--blue-700) 100%);
        color: #fff;
        border-radius: 12px;
        font-size: 0.84rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s cubic-bezier(.4,0,.2,1);
        border: none;
        box-shadow: 0 4px 16px rgba(37,99,235,.35);
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-tambah:hover {
        background: linear-gradient(135deg, var(--blue-700), var(--blue-800));
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,99,235,.45);
        text-decoration: none;
    }
    .btn-tambah .btn-icon {
        width: 22px; height: 22px;
        background: rgba(255,255,255,.2);
        border-radius: 6px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.72rem;
    }

    /* ── STATS ROW ── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.75rem;
    }

    .stat-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid var(--slate-200);
        padding: 1.15rem 1.35rem;
        display: flex;
        align-items: center;
        gap: 14px;
        transition: box-shadow .2s, transform .2s;
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 14px 14px;
    }
    .stat-card:nth-child(1)::after { background: linear-gradient(90deg, var(--blue-500), var(--blue-300)); }
    .stat-card:nth-child(2)::after { background: linear-gradient(90deg, #6366f1, #a5b4fc); }
    .stat-card:nth-child(3)::after { background: linear-gradient(90deg, #0ea5e9, #7dd3fc); }

    .stat-card:hover {
        box-shadow: 0 6px 24px rgba(37,99,235,.1);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 46px; height: 46px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .stat-icon.blue   { background: var(--blue-50);  color: var(--blue-600); }
    .stat-icon.indigo { background: #eef2ff; color: #4f46e5; }
    .stat-icon.sky    { background: #f0f9ff; color: #0284c7; }

    .stat-label { font-size: 0.7rem; font-weight: 700; color: var(--slate-400); text-transform: uppercase; letter-spacing: .5px; }
    .stat-value { font-size: 1.45rem; font-weight: 800; color: var(--navy); letter-spacing: -.5px; line-height: 1.2; margin-top: 2px; }

    /* ── ALERT ── */
    .alert-success-custom {
        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 13px 18px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.4rem;
        font-size: 0.84rem;
        color: #15803d;
        font-weight: 600;
    }
    .alert-success-custom .icon {
        width: 28px; height: 28px;
        background: #22c55e;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 0.72rem;
        flex-shrink: 0;
        box-shadow: 0 2px 8px rgba(34,197,94,.3);
    }
    .alert-success-custom .btn-close-custom {
        margin-left: auto; background: none; border: none;
        cursor: pointer; color: #86efac; font-size: 1rem;
        padding: 0; line-height: 1; transition: color .2s;
    }
    .alert-success-custom .btn-close-custom:hover { color: #4ade80; }

    /* ── TABLE CARD ── */
    .table-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--slate-200);
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(15,32,68,.07);
    }

    /* ── TOOLBAR ── */
    .table-toolbar {
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid var(--slate-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: var(--slate-50);
    }

    .search-input-wrap {
        position: relative;
        flex: 1;
        max-width: 290px;
    }
    .search-input-wrap i {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%);
        color: var(--slate-400); font-size: 0.76rem;
        pointer-events: none;
    }
    .search-input {
        width: 100%;
        padding: 9px 12px 9px 34px;
        border: 1.5px solid var(--slate-200);
        border-radius: 10px;
        font-size: 0.81rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--slate-800);
        outline: none;
        transition: border-color .2s, box-shadow .2s;
        background: #fff;
    }
    .search-input:focus {
        border-color: var(--blue-400);
        box-shadow: 0 0 0 3px rgba(59,130,246,.12);
    }
    .search-input::placeholder { color: var(--slate-300); }

    .table-count {
        font-size: 0.73rem;
        font-weight: 700;
        color: var(--blue-600);
        background: var(--blue-50);
        padding: 5px 13px;
        border-radius: 20px;
        border: 1px solid var(--blue-100);
        white-space: nowrap;
    }

    /* ══════════════════════════════════════
       TABLE — dengan garis pembatas kolom
    ══════════════════════════════════════ */
    .penyakit-table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Header */
    .penyakit-table thead tr {
        background: linear-gradient(135deg, var(--navy) 0%, #1a3a6e 100%);
    }
    .penyakit-table thead th {
        padding: 13px 16px;
        font-size: 0.69rem;
        font-weight: 700;
        color: rgba(255,255,255,.75);
        text-transform: uppercase;
        letter-spacing: .9px;
        white-space: nowrap;
        /* garis pembatas antar header */
        border-right: 1px solid rgba(255,255,255,.1);
    }
    .penyakit-table thead th:last-child { border-right: none; }

    /* Body rows — garis horizontal (baris) */
    .penyakit-table tbody tr {
        border-bottom: 1px solid var(--slate-100);
        transition: background .15s;
        animation: rowFadeIn .3s ease both;
    }
    .penyakit-table tbody tr:last-child { border-bottom: none; }
    .penyakit-table tbody tr:hover { background: #f5f9ff; }

    /* Body cells — garis vertikal (kolom) */
    .penyakit-table td {
        padding: 14px 16px;
        font-size: 0.875rem;
        color: var(--slate-700);
        vertical-align: middle;
        /* garis pembatas antar kolom */
        border-right: 1px solid var(--slate-100);
    }
    .penyakit-table td:last-child { border-right: none; }

    /* Zebra ringan */
    .penyakit-table tbody tr:nth-child(even) { background: #fafcff; }
    .penyakit-table tbody tr:nth-child(even):hover { background: #f0f6ff; }

    /* ── CELLS ── */
    .no-cell {
        font-size: 0.73rem;
        color: var(--slate-400);
        font-weight: 700;
        text-align: center;
    }

    .kode-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: #fff;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1px;
        font-family: 'Courier New', monospace;
        box-shadow: 0 2px 8px rgba(37,99,235,.25);
    }

    .nama-cell { font-weight: 600; color: var(--slate-800); }

    .deskripsi-cell {
        color: var(--slate-500);
        font-size: 0.83rem;
        font-weight: 400;
        max-width: 360px;
    }
    .deskripsi-cell .desc-inner {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.55;
    }

    /* ── ACTION BUTTONS ── */
    .aksi-cell {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        background: #fffbeb;
        color: #b45309;
        border: 1.5px solid #fde68a;
        border-radius: 8px;
        font-size: 0.76rem;
        font-weight: 700;
        text-decoration: none;
        transition: all .2s;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        white-space: nowrap;
    }
    .btn-edit:hover {
        background: #fef3c7;
        color: #92400e;
        border-color: #fbbf24;
        box-shadow: 0 3px 10px rgba(217,119,6,.2);
        transform: translateY(-1px);
        text-decoration: none;
    }

    .btn-hapus {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 14px;
        background: #fff1f2;
        color: #be123c;
        border: 1.5px solid #fecdd3;
        border-radius: 8px;
        font-size: 0.76rem;
        font-weight: 700;
        cursor: pointer;
        transition: all .2s;
        font-family: 'Plus Jakarta Sans', sans-serif;
        white-space: nowrap;
    }
    .btn-hapus:hover {
        background: #ffe4e6;
        color: #9f1239;
        border-color: #fda4af;
        box-shadow: 0 3px 10px rgba(190,18,60,.2);
        transform: translateY(-1px);
    }

    /* ── EMPTY STATE ── */
    .empty-state { padding: 4rem 1rem; text-align: center; }
    .empty-icon-wrap {
        width: 70px; height: 70px;
        background: var(--blue-50);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.1rem;
        font-size: 1.5rem; color: var(--blue-400);
        border: 2px dashed var(--blue-200);
    }
    .empty-title { font-size: .93rem; font-weight: 700; color: var(--slate-600); margin-bottom: 4px; }
    .empty-sub   { font-size: .81rem; color: var(--slate-400); margin-bottom: 1.4rem; }
    .empty-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 20px;
        background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
        color: #fff; border-radius: 10px;
        font-size: .81rem; font-weight: 700; text-decoration: none;
        box-shadow: 0 4px 14px rgba(37,99,235,.3);
        transition: all .2s;
    }
    .empty-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,.4); color:#fff; text-decoration:none; }

    /* ── TABLE FOOTER ── */
    .table-footer {
        padding: 12px 1.4rem;
        border-top: 1px solid var(--slate-100);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--slate-50);
    }
    .footer-info { font-size: .75rem; color: var(--slate-400); font-weight: 500; }
    .footer-info strong { color: var(--blue-600); font-weight: 700; }

    /* ── ROW ANIMATION ── */
    @keyframes rowFadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .penyakit-table tbody tr:nth-child(1) { animation-delay:.03s }
    .penyakit-table tbody tr:nth-child(2) { animation-delay:.06s }
    .penyakit-table tbody tr:nth-child(3) { animation-delay:.09s }
    .penyakit-table tbody tr:nth-child(4) { animation-delay:.12s }
    .penyakit-table tbody tr:nth-child(5) { animation-delay:.15s }

    #noResultRow { display: none; }
    #noResultRow td { text-align:center; padding:2.5rem 1rem; color:var(--slate-400); font-size:.84rem; font-weight:500; border-right:none !important; }

    @media (max-width: 768px) {
        .stats-row { grid-template-columns: 1fr; }
        .page-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .deskripsi-cell { max-width: 150px; }
    }
</style>

<div class="penyakit-wrap">

    {{-- ── PAGE HEADER ── --}}
    <div class="page-header">
        <div class="page-title-group">
            <div class="page-breadcrumb">
                <span>Master Data</span>
                <i class="fas fa-chevron-right"></i>
                <span>Penyakit</span>
            </div>
            <h2 class="page-title">Data <span class="accent">Penyakit</span></h2>
            <p class="page-subtitle">Kelola daftar penyakit ISPA beserta deskripsinya</p>
        </div>
        <a href="{{ route('penyakit.create') }}" class="btn-tambah">
            <span class="btn-icon"><i class="fas fa-plus"></i></span>
            Tambah Penyakit
        </a>
    </div>

    {{-- ── STATS ROW ── --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-virus"></i></div>
            <div class="stat-info">
                <div class="stat-label">Total Penyakit</div>
                <div class="stat-value">{{ $data->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon indigo"><i class="fas fa-tag"></i></div>
            <div class="stat-info">
                <div class="stat-label">Kode Terdaftar</div>
                <div class="stat-value">{{ $data->count() }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon sky"><i class="fas fa-database"></i></div>
            <div class="stat-info">
                <div class="stat-label">Status Data</div>
                <div class="stat-value" style="font-size:1rem;font-weight:700;color:#0284c7;">Aktif</div>
            </div>
        </div>
    </div>

    {{-- ── ALERT ── --}}
    @if(session('success'))
    <div class="alert-success-custom" id="alertSuccess">
        <div class="icon"><i class="fas fa-check"></i></div>
        <span>{{ session('success') }}</span>
        <button class="btn-close-custom" onclick="document.getElementById('alertSuccess').style.display='none'">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    {{-- ── TABLE CARD ── --}}
    <div class="table-card">

        {{-- Toolbar --}}
        <div class="table-toolbar">
            <div class="search-input-wrap">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Cari nama penyakit atau kode...">
            </div>
            <div style="display:flex; align-items:center; gap:10px;">
                <span class="table-count" id="rowCount">{{ $data->count() }} data</span>
            </div>
        </div>

        {{-- Table --}}
        <div style="overflow-x:auto;">
            <table class="penyakit-table" id="penyakitTable">
                <thead>
                    <tr>
                        <th style="width:5%;  text-align:center;">No</th>
                        <th style="width:12%; text-align:center;">Kode</th>
                        <th style="width:22%;">Nama Penyakit</th>
                        <th>Deskripsi</th>
                        <th style="width:17%; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse($data as $index => $p)
                    <tr>
                        <td class="no-cell">{{ $index + 1 }}</td>
                        <td style="text-align:center;">
                            <span class="kode-badge">{{ $p->kode }}</span>
                        </td>
                        <td class="nama-cell">{{ $p->nama }}</td>
                        <td class="deskripsi-cell">
                            <div class="desc-inner">{{ $p->deskripsi }}</div>
                        </td>
                        <td>
                            <div class="aksi-cell">
                                <a href="{{ route('penyakit.edit', $p->id) }}" class="btn-edit">
                                    <i class="fas fa-pen" style="font-size:.65rem;"></i> Edit
                                </a>
                                <form action="{{ route('penyakit.destroy', $p->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus penyakit ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-hapus">
                                        <i class="fas fa-trash" style="font-size:.65rem;"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="5" style="border-right:none;">
                            <div class="empty-state">
                                <div class="empty-icon-wrap"><i class="fas fa-virus-slash"></i></div>
                                <div class="empty-title">Belum ada data penyakit</div>
                                <div class="empty-sub">Tambahkan data penyakit untuk mulai mengelola sistem diagnosis ISPA.</div>
                                <a href="{{ route('penyakit.create') }}" class="empty-btn">
                                    <i class="fas fa-plus"></i> Tambah Penyakit
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                    <tr id="noResultRow">
                        <td colspan="5">
                            <i class="fas fa-search" style="margin-right:8px;color:#94a3b8;"></i>
                            Tidak ada hasil yang cocok dengan pencarian.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        @if($data->count() > 0)
        <div class="table-footer">
            <span class="footer-info">
                Menampilkan <strong id="visibleCount">{{ $data->count() }}</strong>
                dari <strong>{{ $data->count() }}</strong> data penyakit
            </span>
            <span class="footer-info">Sistem Pakar ISPA &mdash; Panel Admin</span>
        </div>
        @endif

    </div><!-- /.table-card -->

</div><!-- /.penyakit-wrap -->

<script>
(function () {
    const searchInput  = document.getElementById('searchInput');
    const rows         = Array.from(document.querySelectorAll('#tableBody tr:not(#emptyRow):not(#noResultRow)'));
    const rowCountEl   = document.getElementById('rowCount');
    const visibleCount = document.getElementById('visibleCount');
    const noResult     = document.getElementById('noResultRow');
    const total        = rows.length;

    function updateUI(visible) {
        if (rowCountEl)   rowCountEl.textContent   = visible + ' data';
        if (visibleCount) visibleCount.textContent = visible;
        if (noResult)     noResult.style.display   = (visible === 0 && total > 0) ? '' : 'none';
    }

    updateUI(total);

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            let visible = 0;
            rows.forEach(row => {
                const match = row.innerText.toLowerCase().includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });
            updateUI(visible);
        });
    }
})();
</script>

@endsection