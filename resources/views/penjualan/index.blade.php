@extends('be.master')

@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-page-subtitle { font-size:0.88rem; color:#64748B; margin:3px 0 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:8px 18px; border-radius:10px; font-size:0.85rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-warning { background:#F97316; color:#fff; }
    .bph-btn-warning:hover { background:#EA6C0A; color:#fff; }
    .bph-btn-danger { background:#EF4444; color:#fff; }
    .bph-btn-danger:hover { background:#DC2626; color:#fff; }
    .bph-btn-sm { padding:5px 12px; font-size:0.78rem; border-radius:8px; }

    /* ===================== STATUS FILTER BUTTONS ===================== */
    .bph-status-filter-wrap { margin-bottom:24px; }
    .bph-status-filter-label { font-size:0.85rem; font-weight:700; color:#334155; margin-bottom:12px; display:block; }
    .bph-status-filter-grid { display:flex; flex-wrap:wrap; gap:10px; align-items:center; }

    .bph-status-btn {
        display:inline-flex; align-items:center; gap:10px;
        padding:10px 18px; border-radius:14px;
        font-size:0.82rem; font-weight:700;
        border:2px solid transparent;
        cursor:pointer; text-decoration:none;
        transition:all 0.22s cubic-bezier(.4,0,.2,1);
        position:relative; white-space:nowrap;
    }
    .bph-status-btn:hover { transform:translateY(-2px); box-shadow:0 6px 18px rgba(0,0,0,0.13); }
    .bph-status-btn.active { box-shadow:0 4px 16px rgba(0,0,0,0.18); transform:translateY(-1px); }

    /* Semua Status */
    .bph-status-btn-all { background:#1A1A2E; color:#F97316; border-color:#2D2D4E; }
    .bph-status-btn-all:hover { background:#2D2D4E; color:#F97316; }
    .bph-status-btn-all.active { background:#F97316; color:#fff; border-color:#F97316; }

    /* Diproses - Biru */
    .bph-status-btn-diproses { background:#EFF6FF; color:#1D4ED8; border-color:#BFDBFE; }
    .bph-status-btn-diproses:hover { background:#DBEAFE; color:#1D4ED8; }
    .bph-status-btn-diproses.active { background:#1D4ED8; color:#fff; border-color:#1D4ED8; }

    /* Menunggu Kurir - Kuning/Amber */
    .bph-status-btn-menunggu { background:#FFFBEB; color:#B45309; border-color:#FDE68A; }
    .bph-status-btn-menunggu:hover { background:#FEF3C7; color:#B45309; }
    .bph-status-btn-menunggu.active { background:#D97706; color:#fff; border-color:#D97706; }

    /* Dibatalkan Penjual - Merah */
    .bph-status-btn-dibatalkan { background:#FEF2F2; color:#B91C1C; border-color:#FECACA; }
    .bph-status-btn-dibatalkan:hover { background:#FEE2E2; color:#B91C1C; }
    .bph-status-btn-dibatalkan.active { background:#DC2626; color:#fff; border-color:#DC2626; }

    /* Selesai - Hijau */
    .bph-status-btn-selesai { background:#F0FDF4; color:#15803D; border-color:#BBF7D0; }
    .bph-status-btn-selesai:hover { background:#DCFCE7; color:#15803D; }
    .bph-status-btn-selesai.active { background:#16A34A; color:#fff; border-color:#16A34A; }

    .bph-status-btn-icon { font-size:1rem; line-height:1; }
    .bph-status-btn-text { font-size:0.82rem; font-weight:700; }

    .bph-status-count-badge {
        display:inline-flex; align-items:center; justify-content:center;
        min-width:22px; height:22px; padding:0 6px;
        border-radius:20px; font-size:0.72rem; font-weight:800;
        background:rgba(255,255,255,0.35);
        border:1.5px solid rgba(255,255,255,0.5);
        transition:all 0.22s;
    }
    .bph-status-btn-all .bph-status-count-badge { background:rgba(249,115,22,0.2); border-color:rgba(249,115,22,0.4); color:#F97316; }
    .bph-status-btn-all.active .bph-status-count-badge { background:rgba(255,255,255,0.25); border-color:rgba(255,255,255,0.5); color:#fff; }
    .bph-status-btn-diproses .bph-status-count-badge { background:#DBEAFE; border-color:#93C5FD; color:#1D4ED8; }
    .bph-status-btn-diproses.active .bph-status-count-badge { background:rgba(255,255,255,0.25); border-color:rgba(255,255,255,0.5); color:#fff; }
    .bph-status-btn-menunggu .bph-status-count-badge { background:#FDE68A; border-color:#FCD34D; color:#92400E; }
    .bph-status-btn-menunggu.active .bph-status-count-badge { background:rgba(255,255,255,0.25); border-color:rgba(255,255,255,0.5); color:#fff; }
    .bph-status-btn-dibatalkan .bph-status-count-badge { background:#FECACA; border-color:#FCA5A5; color:#B91C1C; }
    .bph-status-btn-dibatalkan.active .bph-status-count-badge { background:rgba(255,255,255,0.25); border-color:rgba(255,255,255,0.5); color:#fff; }
    .bph-status-btn-selesai .bph-status-count-badge { background:#BBF7D0; border-color:#86EFAC; color:#15803D; }
    .bph-status-btn-selesai.active .bph-status-count-badge { background:rgba(255,255,255,0.25); border-color:rgba(255,255,255,0.5); color:#fff; }
    /* ============================================================= */

    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.82rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-table thead th { padding:12px 10px; font-size:0.73rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.4px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:10px 10px; color:#334155; vertical-align:middle; text-align:center; border:none; }

    .bph-badge { padding:4px 12px; border-radius:20px; font-size:0.73rem; font-weight:700; white-space:nowrap; }
    .bph-badge-primary { background:#DBEAFE; color:#1D4ED8; }
    .bph-badge-success { background:#DCFCE7; color:#16A34A; }
    .bph-badge-danger { background:#FEE2E2; color:#DC2626; }
    .bph-badge-warning { background:#FEF3C7; color:#D97706; }
    .bph-badge-dark { background:#1A1A2E; color:#F97316; }
    .bph-badge-secondary { background:#F1F5F9; color:#64748B; }

    .bph-resep-thumb { width:56px; height:56px; object-fit:cover; border-radius:8px; border:2px solid #F97316; cursor:pointer; transition:transform 0.2s; }
    .bph-resep-thumb:hover { transform:scale(1.1); }

    .bph-modal-resep { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.75); }
    .bph-modal-content-resep { background:#fff; margin:8% auto; padding:28px; border-radius:16px; max-width:560px; text-align:center; position:relative; }
    .bph-modal-content-resep img { max-width:100%; border-radius:10px; }
    .bph-modal-close { position:absolute; top:12px; right:18px; font-size:1.8rem; font-weight:700; color:#64748B; cursor:pointer; line-height:1; }

    .bph-alert-info { background:#EFF6FF; border:1.5px solid #BFDBFE; color:#1D4ED8; padding:16px 20px; border-radius:12px; text-align:center; font-weight:600; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Daftar Paket</h1>
        <p class="bph-page-subtitle">Paket muncul ketika status diubah oleh Kasir menjadi "DIPROSES"</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Penjualan</span>
        </div>
    </div>
</div>

@php
    $statusYangDitampilkan = ['Diproses', 'Menunggu Kurir', 'Dibatalkan Penjual', 'Selesai'];
    $penjualansFiltered = $penjualans->whereIn('status_order', $statusYangDitampilkan);

    $countAll        = $penjualansFiltered->count();
    $countDiproses   = $penjualansFiltered->where('status_order', 'Diproses')->count();
    $countMenunggu   = $penjualansFiltered->where('status_order', 'Menunggu Kurir')->count();
    $countDibatalkan = $penjualansFiltered->where('status_order', 'Dibatalkan Penjual')->count();
    $countSelesai    = $penjualansFiltered->where('status_order', 'Selesai')->count();
@endphp

<!-- Filter Tombol Status -->
<div class="bph-status-filter-wrap">
    <label class="bph-status-filter-label"><i class="bi bi-funnel-fill me-1" style="color:#F97316;"></i> Filter Status Pesanan</label>
    <div class="bph-status-filter-grid">

        <button type="button"
            class="bph-status-btn bph-status-btn-all active"
            onclick="bphFilterByStatus('', this)">
            <span class="bph-status-btn-icon"><i class="bi bi-grid-fill"></i></span>
            <span class="bph-status-btn-text">Semua</span>
            <span class="bph-status-count-badge">{{ $countAll }}</span>
        </button>

        <button type="button"
            class="bph-status-btn bph-status-btn-diproses"
            onclick="bphFilterByStatus('Diproses', this)">
            <span class="bph-status-btn-icon"><i class="bi bi-arrow-repeat"></i></span>
            <span class="bph-status-btn-text">Diproses</span>
            <span class="bph-status-count-badge">{{ $countDiproses }}</span>
        </button>

        <button type="button"
            class="bph-status-btn bph-status-btn-menunggu"
            onclick="bphFilterByStatus('Menunggu Kurir', this)">
            <span class="bph-status-btn-icon"><i class="bi bi-truck"></i></span>
            <span class="bph-status-btn-text">Menunggu Kurir</span>
            <span class="bph-status-count-badge">{{ $countMenunggu }}</span>
        </button>

        <button type="button"
            class="bph-status-btn bph-status-btn-dibatalkan"
            onclick="bphFilterByStatus('Dibatalkan Penjual', this)">
            <span class="bph-status-btn-icon"><i class="bi bi-x-circle-fill"></i></span>
            <span class="bph-status-btn-text">Dibatalkan Penjual</span>
            <span class="bph-status-count-badge">{{ $countDibatalkan }}</span>
        </button>

        <button type="button"
            class="bph-status-btn bph-status-btn-selesai"
            onclick="bphFilterByStatus('Selesai', this)">
            <span class="bph-status-btn-icon"><i class="bi bi-check-circle-fill"></i></span>
            <span class="bph-status-btn-text">Selesai</span>
            <span class="bph-status-count-badge">{{ $countSelesai }}</span>
        </button>

    </div>
</div>

@if($penjualansFiltered->isEmpty())
    <div class="bph-alert-info"><i class="bi bi-info-circle me-2"></i>Tidak ada pesanan paket</div>
@else
<div class="bph-card">
    <div class="bph-table-scroll">
        <table class="bph-table" id="bphPenjualanTable">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No Penjualan</th>
                    <th>Metode Bayar</th>
                    <th>Tanggal</th>
                    <th>Resep</th>
                    <th>Ongkir</th>
                    <th>Biaya App</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Jenis Kirim</th>
                    <th>Pelanggan</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualansFiltered as $penjualan)
                    <tr data-status="{{ $penjualan->status_order }}">
                        <td>
                            <div style="display:flex; gap:4px; justify-content:center; flex-wrap:wrap;">
                                @if($penjualan->status_order != 'Selesai')
                                    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endif
                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline bph-form-delete">
                                    @csrf @method('DELETE')
                                    <button type="button" class="bph-btn bph-btn-danger bph-btn-sm bph-btn-delete"><i class="bi bi-trash3"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                        <td style="font-weight:700;">{{ $penjualan->id }}</td>
                        <td>{{ $penjualan->id_metode_bayar }}</td>
                        <td style="font-size:0.78rem;">{{ $penjualan->tgl_penjualan }}</td>
                        <td>
                            @if($penjualan->url_resep)
                                <img src="{{ $penjualan->url_resep }}" alt="Resep" class="bph-resep-thumb" onclick="bphShowModal('{{ $penjualan->url_resep }}')">
                            @else <span style="color:#CBD5E1;">-</span> @endif
                        </td>
                        <td>Rp {{ number_format($penjualan->ongkos_kirim, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->biaya_app, 2, ',', '.') }}</td>
                        <td style="font-weight:700; color:#F97316;">Rp {{ number_format($penjualan->total_bayar, 2, ',', '.') }}</td>
                        <td>
                            <span class="bph-badge
                                @if($penjualan->status_order=='Diproses') bph-badge-primary
                                @elseif($penjualan->status_order=='Selesai') bph-badge-success
                                @elseif($penjualan->status_order=='Dibatalkan Penjual') bph-badge-danger
                                @elseif($penjualan->status_order=='Menunggu Kurir') bph-badge-warning
                                @elseif($penjualan->status_order=='Bermasalah') bph-badge-dark
                                @else bph-badge-secondary @endif">
                                {{ $penjualan->status_order }}
                            </span>
                        </td>
                        <td>{{ $penjualan->keterangan_status ?? '-' }}</td>
                        <td>{{ $penjualan->jenisPengiriman->jenis_kirim ?? '-' }}</td>
                        <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td style="font-size:0.72rem; color:#94A3B8;">{{ $penjualan->created_at }}</td>
                        <td style="font-size:0.72rem; color:#94A3B8;">{{ $penjualan->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Modal Resep -->
<div id="bphModalResep" class="bph-modal-resep">
    <div class="bph-modal-content-resep">
        <span class="bph-modal-close" onclick="bphCloseModal()">&times;</span>
        <img id="bphResepImage" src="" alt="Resep Dokter">
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function bphShowModal(url) {
        document.getElementById('bphResepImage').src = url;
        document.getElementById('bphModalResep').style.display = 'block';
    }
    function bphCloseModal() { document.getElementById('bphModalResep').style.display = 'none'; }
    window.addEventListener('click', function(e) { if (e.target === document.getElementById('bphModalResep')) bphCloseModal(); });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.bph-btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#F97316',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => { if (result.isConfirmed) form.submit(); });
            });
        });
    });

    function bphFilterByStatus(status, clickedBtn) {
        // Update active state semua tombol
        document.querySelectorAll('.bph-status-btn').forEach(btn => btn.classList.remove('active'));
        clickedBtn.classList.add('active');

        // Filter baris tabel
        const sel = status.toLowerCase();
        document.querySelectorAll('#bphPenjualanTable tbody tr').forEach(row => {
            const st = row.getAttribute('data-status').toLowerCase();
            row.style.display = (!sel || st === sel) ? '' : 'none';
        });
    }
</script>
@endsection