@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-page-subtitle { font-size:0.88rem; color:#64748B; margin:3px 0 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 20px; border-radius:10px; font-size:0.88rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-success { background:linear-gradient(135deg,#16A34A,#4ADE80); color:#fff; box-shadow:0 4px 14px rgba(22,163,74,0.25); }
    .bph-btn-success:hover { background:linear-gradient(135deg,#15803D,#16A34A); color:#fff; }

    .bph-summary-grid { display:flex; flex-wrap:wrap; gap:20px; margin-bottom:28px; }
    .bph-summary-card { flex:1; min-width:200px; background:#fff; border-radius:14px; padding:24px; box-shadow:0 4px 16px rgba(30,30,60,0.07); border:1.5px solid #F1F5F9; text-align:center; transition:transform 0.2s ease; }
    .bph-summary-card:hover { transform:translateY(-4px); }
    .bph-summary-card h5 { font-size:0.85rem; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:10px; }
    .bph-summary-card p { font-size:1.3rem; font-weight:800; color:#F97316; margin:0; }

    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-card-head { padding:16px 24px; background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-card-head h5 { margin:0; font-size:1rem; font-weight:700; color:#F97316; display:flex; align-items:center; gap:8px; }
    .bph-card-body { padding:24px; }

    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.875rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#F97316,#FDBA74); }
    .bph-table thead th { padding:12px 14px; font-size:0.78rem; font-weight:700; color:#fff; text-transform:uppercase; border:none; text-align:center; white-space:nowrap; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; cursor:pointer; }
    .bph-table tbody tr:hover, .bph-table tbody tr.bph-row-active { background:#FFF7ED; }
    .bph-table tbody td { padding:12px 14px; color:#334155; vertical-align:middle; text-align:center; border:none; }

    .bph-badge-success { background:#DCFCE7; color:#16A34A; padding:4px 12px; border-radius:20px; font-size:0.78rem; font-weight:700; }
    .bph-alert-info { background:#EFF6FF; border:1.5px solid #BFDBFE; color:#1D4ED8; padding:16px 20px; border-radius:12px; text-align:center; font-weight:600; }
</style>

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Laporan Penjualan</h1>
        <p class="bph-page-subtitle">Hanya data penjualan dengan status "SELESAI" yang ditampilkan</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Laporan Penjualan</span>
        </div>
    </div>
    <a href="{{ url('/laporan/penjualan/download') }}" class="bph-btn bph-btn-success" target="_blank">
        <i class="bi bi-file-earmark-arrow-down"></i> Download Laporan
    </a>
</div>

<!-- Summary -->
<div class="bph-summary-grid">
    <div class="bph-summary-card">
        <h5><i class="bi bi-receipt me-1"></i> Total Penjualan</h5>
        <p>{{ number_format($totalPenjualan) }} Transaksi</p>
    </div>
    <div class="bph-summary-card">
        <h5><i class="bi bi-cash-coin me-1"></i> Total Pendapatan</h5>
        <p>Rp {{ number_format($totalBayar, 2, ',', '.') }}</p>
    </div>
</div>

<!-- Table -->
<div class="bph-card">
    <div class="bph-card-head">
        <h5><i class="bi bi-table"></i> Detail Transaksi Penjualan</h5>
    </div>
    <div class="bph-card-body">
        @if($penjualan->isEmpty())
            <div class="bph-alert-info">
                <i class="bi bi-info-circle me-2"></i><strong>Tidak Ada Data Penjualan</strong>.
            </div>
        @else
            <div class="bph-table-scroll">
                <table class="bph-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                            <th>Status Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan as $index => $penjualan)
                            <tr class="bph-table-row">
                                <td>{{ $index + 1 }}</td>
                                <td style="font-weight:700; text-align:left;">{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($penjualan->tgl_penjualan)->format('d/m/Y H:i') }}</td>
                                <td style="font-weight:700; color:#F97316;">Rp {{ number_format($penjualan->total_bayar, 2, ',', '.') }}</td>
                                <td><span class="bph-badge-success">{{ $penjualan->status_order }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.querySelectorAll('.bph-table-row').forEach(row => {
        row.addEventListener('click', () => {
            document.querySelectorAll('.bph-table-row').forEach(r => r.classList.remove('bph-row-active'));
            row.classList.add('bph-row-active');
        });
    });
</script>
@endsection
