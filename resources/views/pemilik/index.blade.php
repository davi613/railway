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
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-stat-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    @media (max-width: 900px) { .bph-stat-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 540px) { .bph-stat-grid { grid-template-columns: 1fr; } }

    .bph-stat-card {
        border-radius: 18px;
        padding: 28px 24px;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 8px 28px rgba(0,0,0,0.12);
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease;
    }
    .bph-stat-card:hover { transform: translateY(-4px); }
    .bph-stat-card::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 130px; height: 130px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
    }
    .bph-stat-card-1 { background: linear-gradient(135deg, #F97316 0%, #FDBA74 100%); }
    .bph-stat-card-2 { background: linear-gradient(135deg, #1A1A2E 0%, #2D2D4E 100%); }
    .bph-stat-card-3 { background: linear-gradient(135deg, #16A34A 0%, #4ADE80 100%); }

    .bph-stat-info h6 { font-size:0.78rem; font-weight:700; opacity:0.85; text-transform:uppercase; letter-spacing:1px; margin:0 0 8px; }
    .bph-stat-info h2 { font-size:1.75rem; font-weight:800; margin:0; }
    .bph-stat-icon { font-size:2.5rem; opacity:0.8; position:relative; z-index:1; }

    .bph-section-title { font-size:1rem; font-weight:700; color:#1A1A2E; margin-bottom:16px; display:flex; align-items:center; gap:8px; }
    .bph-section-title i { color:#F97316; }

    .bph-action-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 28px;
    }

    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:11px 22px; border-radius:10px; font-size:0.9rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-2px); box-shadow:0 6px 18px rgba(0,0,0,0.15); }
    .bph-btn-orange { background:linear-gradient(135deg,#F97316,#FDBA74); color:#fff; }
    .bph-btn-navy { background:linear-gradient(135deg,#1A1A2E,#2D2D4E); color:#fff; }
    .bph-btn-green { background:linear-gradient(135deg,#16A34A,#4ADE80); color:#fff; }
</style>

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Dashboard Pemilik</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <span>Dashboard</span>
            <span class="sep">/</span>
            <span>Pemilik</span>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="bph-stat-grid">
    <div class="bph-stat-card bph-stat-card-1">
        <div class="bph-stat-info">
            <h6>Total Pelanggan</h6>
            <h2>{{ number_format($totalPelanggan) }}</h2>
        </div>
        <div class="bph-stat-icon"><i class="bi bi-people-fill"></i></div>
    </div>
    <div class="bph-stat-card bph-stat-card-2">
        <div class="bph-stat-info">
            <h6>Total Penjualan (Online)</h6>
            <h2>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
        </div>
        <div class="bph-stat-icon"><i class="bi bi-currency-exchange"></i></div>
    </div>
    <div class="bph-stat-card bph-stat-card-3">
        <div class="bph-stat-info">
            <h6>Total Pembelian</h6>
            <h2>Rp {{ number_format($totalPembelian, 0, ',', '.') }}</h2>
        </div>
        <div class="bph-stat-icon"><i class="bi bi-cart4"></i></div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bph-section-title"><i class="bi bi-lightning-charge-fill"></i> Quick Actions</div>
<div class="bph-action-grid">
    <a href="{{ url('/laporan/penjualan/download') }}" target="_blank" class="bph-btn bph-btn-orange">
        <i class="bi bi-file-earmark-arrow-down"></i> Unduh Laporan Penjualan
    </a>
    <a href="{{ url('/laporan/pembelian/download') }}" target="_blank" class="bph-btn bph-btn-navy">
        <i class="bi bi-file-earmark-arrow-down"></i> Unduh Laporan Pembelian
    </a>
    <a href="{{ route('laporan.jual.pdf') }}" target="_blank" class="bph-btn bph-btn-green">
        <i class="bi bi-receipt"></i> Unduh Laporan Kasir
    </a>
</div>
@endsection
