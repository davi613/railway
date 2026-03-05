@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-alert-success { background:#F0FDF4; border:1.5px solid #BBF7D0; color:#15803D; padding:12px 18px; border-radius:10px; margin-bottom:20px; display:flex; align-items:center; gap:9px; font-weight:600; font-size:0.9rem; }

    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:7px 16px; border-radius:9px; font-size:0.82rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-warning { background:#F97316; color:#fff; }
    .bph-btn-warning:hover { background:#EA6C0A; color:#fff; }

    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-card-head { padding:20px 28px; border-bottom:1.5px solid #F1F5F9; background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-card-head h4 { margin:0; font-size:1.05rem; font-weight:700; color:#F97316; display:flex; align-items:center; gap:8px; }

    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.875rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-table thead th { padding:13px 14px; font-size:0.78rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.5px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:12px 14px; color:#334155; vertical-align:middle; text-align:center; border:none; }

    .bph-stok-badge { display:inline-block; padding:4px 14px; border-radius:20px; font-size:0.8rem; font-weight:700; }
    .bph-stok-ok { background:#DCFCE7; color:#16A34A; }
    .bph-stok-low { background:#FEF3C7; color:#D97706; }
    .bph-stok-empty { background:#FEE2E2; color:#DC2626; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Daftar Harga & Stok Obat</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Stok Obat</span>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="bph-alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="bph-card">
    <div class="bph-card-head">
        <h4><i class="bi bi-box-seam-fill"></i> Data Harga & Stok Obat</h4>
    </div>
    <div class="bph-table-scroll">
        <table class="bph-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($obat as $item)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td style="font-weight:700; text-align:left;">{{ $item->nama_obat }}</td>
                    <td style="font-weight:700; color:#F97316;">Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                    <td>
                        <span class="bph-stok-badge {{ $item->stok > 20 ? 'bph-stok-ok' : ($item->stok > 0 ? 'bph-stok-low' : 'bph-stok-empty') }}">
                            {{ $item->stok }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('stok_obat.edit', $item->id) }}" class="bph-btn bph-btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
