@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Dashboard Admin</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <span class="sep">/</span>
            <span>Dashboard</span>
        </div>
    </div>
    <div style="display:flex; align-items:center; gap:6px; font-size:0.82rem; color:var(--bph-muted);">
        <i class="bi bi-calendar3" style="color:var(--bph-orange);"></i>
        {{ now()->isoFormat('dddd, D MMMM Y') }}
    </div>
</div>

<!-- Stats Grid -->
<div class="bph-stats-grid">

    <!-- Total Users -->
    <div class="bph-stat">
        <div class="bph-stat-ico bph-ico-orange">
            <i class="bi bi-people-fill"></i>
        </div>
        <div>
            <div class="bph-stat-lbl">Total Users</div>
            <div class="bph-stat-val">{{ $totalUsers }}</div>
            <div class="bph-stat-sub">Akun terdaftar</div>
        </div>
    </div>

    <!-- Active User -->
    <div class="bph-stat">
        <div class="bph-stat-ico bph-ico-dark">
            <i class="bi bi-person-check-fill"></i>
        </div>
        <div>
            <div class="bph-stat-lbl">Active User</div>
            <div class="bph-stat-val" style="font-size:1.05rem; padding-top:2px;">{{ Auth::user()->name }}</div>
            <div class="bph-stat-sub"><span class="bph-badge bph-badge-green" style="font-size:0.68rem;"><i class="bi bi-circle-fill" style="font-size:0.45rem;"></i> Online</span></div>
        </div>
    </div>

    <!-- Download Report -->
    <div class="bph-stat bph-stat-action">
        <div class="bph-stat-top">
            <div class="bph-stat-ico bph-ico-green">
                <i class="bi bi-file-earmark-pdf-fill"></i>
            </div>
            <div>
                <div class="bph-stat-lbl">Laporan Admin</div>
                <div class="bph-stat-sub">Unduh dalam format PDF</div>
            </div>
        </div>
        <a href="{{ route('laporan.admin.pdf') }}" class="bph-btn bph-btn-success bph-btn-sm bph-w-100" style="justify-content:center;">
            <i class="bi bi-download"></i> Download PDF
        </a>
    </div>

    <!-- Quick Action -->
    <div class="bph-stat bph-stat-action">
        <div class="bph-stat-top">
            <div class="bph-stat-ico bph-ico-blue">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <div>
                <div class="bph-stat-lbl">Quick Action</div>
                <div class="bph-stat-sub">Buat akun user baru</div>
            </div>
        </div>
        <a href="{{ route('users.create') }}" class="bph-btn bph-btn-primary bph-btn-sm bph-w-100" style="justify-content:center;">
            <i class="bi bi-plus-lg"></i> Tambah User Baru
        </a>
    </div>

</div>

<!-- System Summary -->
<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-display-fill"></i>
            System Summary
        </div>
        <span class="bph-badge bph-badge-green">
            <i class="bi bi-circle-fill" style="font-size:0.45rem;"></i> Server Online
        </span>
    </div>
    <div class="bph-card-body">
        <div style="display:grid; grid-template-columns: 1fr auto; gap:24px; align-items:center;">
            <div style="display:flex; flex-direction:column; gap:12px;">

                <div style="display:flex; align-items:center; gap:14px; padding:14px 16px; background:var(--bph-bg); border-radius:8px; border:1px solid var(--bph-border);">
                    <div style="width:40px;height:40px;border-radius:9px;background:#DCFCE7;color:#15803D;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
                        <i class="bi bi-server"></i>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.06em;color:var(--bph-muted);">Status Server</div>
                        <div style="font-weight:700;margin-top:2px;">
                            <span class="bph-badge bph-badge-green"><i class="bi bi-circle-fill" style="font-size:0.45rem;"></i> Online &amp; Berjalan Normal</span>
                        </div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:14px; padding:14px 16px; background:var(--bph-bg); border-radius:8px; border:1px solid var(--bph-border);">
                    <div style="width:40px;height:40px;border-radius:9px;background:var(--bph-orange-soft);color:var(--bph-orange);display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.06em;color:var(--bph-muted);">Tanggal Hari Ini</div>
                        <div style="font-weight:700;color:var(--bph-dark);margin-top:2px;">{{ now()->format('l, d F Y') }}</div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:14px; padding:14px 16px; background:var(--bph-bg); border-radius:8px; border:1px solid var(--bph-border);">
                    <div style="width:40px;height:40px;border-radius:9px;background:#DBEAFE;color:#1D4ED8;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div>
                        <div style="font-size:0.72rem;font-weight:800;text-transform:uppercase;letter-spacing:0.06em;color:var(--bph-muted);">Role Aktif</div>
                        <div style="font-weight:700;color:var(--bph-dark);margin-top:2px;">Administrator</div>
                    </div>
                </div>

            </div>

            <div style="text-align:center; padding:10px 16px;">
                <img src="https://img.icons8.com/3d-fluency/100/monitor.png" width="90" alt="monitor" style="opacity:0.9;">
                <div style="font-size:0.73rem; color:var(--bph-muted); margin-top:8px; font-weight:600;">System Monitor</div>
            </div>
        </div>
    </div>
</div>

@endsection
