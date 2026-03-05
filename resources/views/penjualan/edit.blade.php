@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }
    .bph-form-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; overflow:hidden; margin-bottom:28px; }
    .bph-form-card-head { padding:20px 28px; border-bottom:1.5px solid #F1F5F9; background:linear-gradient(90deg,#1A1A2E 0%,#2D2D4E 100%); display:flex; align-items:center; gap:10px; }
    .bph-form-card-head h4 { margin:0; font-size:1.1rem; font-weight:700; color:#F97316; display:flex; align-items:center; gap:8px; }
    .bph-form-body { padding:32px 28px; }
    .bph-form-label { font-size:0.85rem; font-weight:700; color:#334155; margin-bottom:6px; display:block; }
    .bph-form-control { width:100%; padding:10px 14px; border-radius:10px; border:1.5px solid #E2E8F0; font-size:0.9rem; color:#1A1A2E; background:#FAFAFA; outline:none; transition:border 0.2s,box-shadow 0.2s; box-sizing:border-box; }
    .bph-form-control:focus { border-color:#F97316; background:#fff; box-shadow:0 0 0 3px rgba(249,115,22,0.1); }
    .bph-form-group { margin-bottom:20px; }
    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:10px 22px; border-radius:10px; font-size:0.9rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-primary { background:linear-gradient(135deg,#F97316,#FDBA74); color:#fff; }
    .bph-btn-primary:hover { background:linear-gradient(135deg,#EA6C0A,#F97316); color:#fff; }
    .bph-btn-secondary { background:#1A1A2E; color:#F97316; }
    .bph-btn-secondary:hover { background:#2D2D4E; color:#FDBA74; }
    .bph-form-footer { display:flex; justify-content:flex-end; gap:12px; margin-top:28px; padding-top:20px; border-top:1.5px solid #F1F5F9; }
    @media (max-width:640px) { .bph-form-body { padding:20px 16px; } .bph-form-footer { flex-direction:column; } .bph-btn { width:100%; justify-content:center; } }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Edit Penjualan</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('penjualan.index') }}">Penjualan</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>
    </div>
</div>

<div class="bph-form-card">
    <div class="bph-form-card-head">
        <h4><i class="bi bi-pencil-square"></i> Edit Status Penjualan</h4>
    </div>
    <div class="bph-form-body">
        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bph-form-group">
                <label class="bph-form-label" for="status_order">Status Order</label>
                <select name="status_order" id="status_order" class="bph-form-control" required style="color:black;">
                    <option value="Menunggu Kurir" {{ $penjualan->status_order == 'Menunggu Kurir' ? 'selected' : '' }}>Menunggu Kurir</option>
                    <option value="Dibatalkan Penjual" {{ $penjualan->status_order == 'Dibatalkan Penjual' ? 'selected' : '' }}>Dibatalkan Penjual</option>
                    <option value="Bermasalah" {{ $penjualan->status_order == 'Bermasalah' ? 'selected' : '' }}>Bermasalah</option>
                    <option value="Selesai" {{ $penjualan->status_order == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="keterangan_status">Keterangan Status</label>
                <input type="text" name="keterangan_status" id="keterangan_status" class="bph-form-control" value="{{ $penjualan->keterangan_status }}">
            </div>

            <div class="bph-form-footer">
                <a href="{{ route('penjualan.index') }}" class="bph-btn bph-btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="bph-btn bph-btn-primary"><i class="bi bi-check-circle"></i> Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
