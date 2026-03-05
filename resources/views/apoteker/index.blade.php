@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    /* ===== APOTEKER INDEX ===== */
    .bph-page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .bph-page-title {
        font-size: 1.55rem;
        font-weight: 800;
        color: #1A1A2E;
        margin: 0 0 4px 0;
        letter-spacing: -0.5px;
    }
    .bph-breadcrumb {
        font-size: 0.82rem;
        color: #8A8FA8;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .bph-breadcrumb a {
        color: #F97316;
        text-decoration: none;
        font-weight: 600;
    }
    .bph-breadcrumb .sep { color: #CBD5E1; }

    .bph-welcome-hero {
        background: linear-gradient(135deg, #F97316 0%, #FDBA74 60%, #FFF7ED 100%);
        border-radius: 20px;
        padding: 48px 40px;
        text-align: center;
        margin-bottom: 32px;
        box-shadow: 0 8px 32px rgba(249,115,22,0.18);
        position: relative;
        overflow: hidden;
    }
    .bph-welcome-hero::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(255,255,255,0.13);
    }
    .bph-welcome-hero::after {
        content: '';
        position: absolute;
        bottom: -30px; left: -30px;
        width: 150px; height: 150px;
        border-radius: 50%;
        background: rgba(255,255,255,0.10);
    }
    .bph-welcome-hero h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }
    .bph-welcome-hero p {
        font-size: 1.1rem;
        color: rgba(255,255,255,0.92);
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .bph-feature-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }
    @media (max-width: 900px) {
        .bph-feature-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 580px) {
        .bph-feature-grid { grid-template-columns: 1fr; }
        .bph-welcome-hero { padding: 32px 20px; }
        .bph-welcome-hero h2 { font-size: 1.4rem; }
    }

    .bph-feat-card {
        background: #fff;
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        box-shadow: 0 4px 18px rgba(249,115,22,0.08);
        border: 1.5px solid #FEE2CA;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        opacity: 0;
        transform: translateY(24px);
        animation: bphFadeUp 0.5s forwards;
    }
    .bph-feat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 32px rgba(249,115,22,0.16);
    }
    .bph-feat-icon {
        width: 68px; height: 68px;
        border-radius: 50%;
        background: linear-gradient(135deg, #FFF7ED, #FDBA74);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px auto;
        font-size: 2rem;
        color: #F97316;
        box-shadow: 0 4px 14px rgba(249,115,22,0.15);
    }
    .bph-feat-card h5 {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1A1A2E;
        margin-bottom: 8px;
    }
    .bph-feat-card p {
        font-size: 0.88rem;
        color: #64748B;
        margin: 0;
        line-height: 1.6;
    }

    @keyframes bphFadeUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Dashboard Apoteker</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <span>Dashboard</span>
            <span class="sep">/</span>
            <span>Apoteker</span>
        </div>
    </div>
</div>

<!-- Welcome Hero -->
<div class="bph-welcome-hero">
    <h2><i class="bi bi-capsule-pill me-2"></i>Selamat Datang, Apoteker</h2>
    <p>"Meracik ketelitian, menyembuhkan dengan dedikasi."</p>
</div>

<!-- Feature Cards -->
<div class="bph-feature-grid">
    <div class="bph-feat-card" style="animation-delay:0.1s;">
        <div class="bph-feat-icon"><i class="bi bi-capsule"></i></div>
        <h5>Manajemen Obat</h5>
        <p>Kelola data obat dengan mudah dan aman.</p>
    </div>
    <div class="bph-feat-card" style="animation-delay:0.25s;">
        <div class="bph-feat-icon"><i class="bi bi-file-earmark-medical"></i></div>
        <h5>Keakuratan Resep</h5>
        <p>Pastikan setiap obat sesuai dengan resep dokter.</p>
    </div>
    <div class="bph-feat-card" style="animation-delay:0.4s;">
        <div class="bph-feat-icon"><i class="bi bi-shield-check"></i></div>
        <h5>Profesionalisme</h5>
        <p>Jaga kepercayaan dengan pelayanan yang optimal.</p>
    </div>
</div>
@endsection
