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
    .bph-btn-danger { background:#EF4444; color:#fff; }
    .bph-btn-danger:hover { background:#DC2626; color:#fff; }
    .bph-btn-success { background:#16A34A; color:#fff; }
    .bph-btn-success:hover { background:#15803D; color:#fff; }
    .bph-form-footer { display:flex; justify-content:flex-end; gap:12px; margin-top:28px; padding-top:20px; border-top:1.5px solid #F1F5F9; }
    @media (max-width:640px) { .bph-form-body { padding:20px 16px; } .bph-form-footer { flex-direction:column; } .bph-btn { width:100%; justify-content:center; } }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Edit Pembelian</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('pembelian.index') }}">Pembelian</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>
    </div>
</div>

<div class="bph-form-card">
    <div class="bph-form-card-head">
        <h4><i class="bi bi-pencil-square"></i> Edit Data Pembelian</h4>
    </div>
    <div class="bph-form-body">
        <form action="{{ route('pembelian.update', $pembelian->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bph-form-group">
                <label class="bph-form-label" for="nonota">No Nota</label>
                <input type="text" class="bph-form-control" id="nonota" name="nonota" value="{{ $pembelian->nonota }}" required>
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="tgl_pembelian">Tanggal Pembelian</label>
                <input type="date" class="bph-form-control" id="tgl_pembelian" name="tgl_pembelian" value="{{ $pembelian->tgl_pembelian }}" required>
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="total_bayar">Total Bayar</label>
                <input type="number" step="0.01" class="bph-form-control" id="total_bayar" name="total_bayar" value="{{ $pembelian->total_bayar }}" required>
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="id_distributor">Distributor</label>
                <select class="bph-form-control" id="id_distributor" name="id_distributor" required style="color:black;">
                    @foreach ($distributors as $distributor)
                        <option value="{{ $distributor->id }}" {{ $pembelian->id_distributor == $distributor->id ? 'selected' : '' }}>
                            {{ $distributor->nama_distributor }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="bph-form-footer">
                <a href="{{ route('pembelian.index') }}" class="bph-btn bph-btn-danger"><i class="bi bi-x-circle"></i> Batal</a>
                <button type="submit" class="bph-btn bph-btn-success"><i class="bi bi-check-circle"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
