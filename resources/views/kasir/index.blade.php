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

    .bph-kasir-hero {
        background: linear-gradient(135deg, #1A1A2E 0%, #2D2D4E 40%, #F97316 100%);
        border-radius: 20px; padding: 48px 40px; text-align: center;
        margin-bottom: 32px; box-shadow: 0 8px 32px rgba(249,115,22,0.2);
        position: relative; overflow: hidden;
    }
    .bph-kasir-hero::before { content:''; position:absolute; top:-40px; right:-40px; width:180px; height:180px; border-radius:50%; background:rgba(255,255,255,0.07); }
    .bph-kasir-hero::after { content:''; position:absolute; bottom:-30px; left:-30px; width:140px; height:140px; border-radius:50%; background:rgba(255,255,255,0.05); }
    .bph-kasir-hero h2 { font-size:2rem; font-weight:800; color:#fff; margin-bottom:10px; position:relative; z-index:1; }
    .bph-kasir-hero p { font-size:1.05rem; color:rgba(255,255,255,0.88); margin:0; position:relative; z-index:1; }

    .bph-feature-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:24px; margin-bottom:24px; }
    @media (max-width:900px) { .bph-feature-grid { grid-template-columns:repeat(2,1fr); } }
    @media (max-width:580px) { .bph-feature-grid { grid-template-columns:1fr; } .bph-kasir-hero { padding:32px 20px; } .bph-kasir-hero h2 { font-size:1.4rem; } }

    .bph-feat-card { background:#fff; border-radius:16px; padding:32px 24px; text-align:center; box-shadow:0 4px 18px rgba(249,115,22,0.08); border:1.5px solid #FEE2CA; transition:transform 0.25s ease, box-shadow 0.25s ease; opacity:0; transform:translateY(24px); animation:bphFadeUp 0.5s forwards; }
    .bph-feat-card:hover { transform:translateY(-6px); box-shadow:0 12px 32px rgba(249,115,22,0.16); }
    .bph-feat-icon { width:68px; height:68px; border-radius:50%; background:linear-gradient(135deg,#FFF7ED,#FDBA74); display:flex; align-items:center; justify-content:center; margin:0 auto 18px; font-size:2rem; color:#F97316; box-shadow:0 4px 14px rgba(249,115,22,0.15); }
    .bph-feat-card h5 { font-size:1.05rem; font-weight:700; color:#1A1A2E; margin-bottom:8px; }
    .bph-feat-card p { font-size:0.88rem; color:#64748B; margin:0; line-height:1.6; }

    @keyframes bphFadeUp { to { opacity:1; transform:translateY(0); } }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Dashboard Kasir</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <span>Dashboard</span>
            <span class="sep">/</span>
            <span>Kasir</span>
        </div>
    </div>
</div>

<div class="bph-kasir-hero">
    <h2><i class="bi bi-cash-register me-2"></i>Selamat Datang, Kasir</h2>
    <p>"Ketelitian dan kecepatan Anda adalah kunci dalam melayani pelanggan dengan baik."</p>
</div>

<div class="bph-feature-grid">
    <div class="bph-feat-card" style="animation-delay:0.1s;">
        <div class="bph-feat-icon"><i class="bi bi-cash-register"></i></div>
        <h5>Transaksi Cepat</h5>
        <p>Layani pembelian dengan sistem yang efisien dan user-friendly.</p>
    </div>
    <div class="bph-feat-card" style="animation-delay:0.25s;">
        <div class="bph-feat-icon"><i class="bi bi-receipt-cutoff"></i></div>
        <h5>Pencatatan Rapi</h5>
        <p>Pastikan setiap transaksi tercatat dengan akurat dan aman.</p>
    </div>
    <div class="bph-feat-card" style="animation-delay:0.4s;">
        <div class="bph-feat-icon"><i class="bi bi-person-heart"></i></div>
        <h5>Pelayanan Prima</h5>
        <p>Berikan pengalaman terbaik untuk setiap pelanggan yang datang.</p>
    </div>
</div>
@endsection
