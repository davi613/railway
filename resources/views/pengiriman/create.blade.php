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
    .bph-page-subtitle { font-size:0.88rem; color:#64748B; margin:3px 0 0; }
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
    .bph-err { color:#EF4444; font-size:0.8rem; margin-top:4px; display:block; }
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
        <h1 class="bph-page-title">Tambah Pengiriman</h1>
        <p class="bph-page-subtitle">Hanya paket dengan status "MENUNGGU KURIR" yang ditampilkan</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('pengiriman.index') }}">Pengiriman</a>
            <span class="sep">/</span>
            <span>Tambah</span>
        </div>
    </div>
    <a href="{{ route('pengiriman.index') }}" class="bph-btn bph-btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-form-card">
    <div class="bph-form-card-head">
        <h4><i class="bi bi-truck"></i> Tambah Pengiriman</h4>
    </div>
    <div class="bph-form-body">
        <form action="{{ route('pengiriman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bph-form-group">
                <label class="bph-form-label" for="id_penjualan">ID Penjualan</label>
                <select class="bph-form-control" id="id_penjualan" name="id_penjualan" required style="color:black;">
                    <option value="">Pilih ID Penjualan</option>
                    @foreach($penjualans as $penjualan)
                        <option value="{{ $penjualan->id }}">
                            {{ $penjualan->id }} - Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
                @error('id_penjualan') <span class="bph-err">{{ $message }}</span> @enderror
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="no_invoice">No. Invoice</label>
                <input type="text" class="bph-form-control" id="no_invoice" name="no_invoice" value="{{ rand(1000000, 9999999) }}" readonly>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="bph-form-group">
                        <label class="bph-form-label" for="tgl_kirim">Tanggal Kirim</label>
                        <input type="datetime-local" class="bph-form-control" id="tgl_kirim" name="tgl_kirim" required>
                        @error('tgl_kirim') <span class="bph-err">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bph-form-group">
                        <label class="bph-form-label" for="status">Status Kirim</label>
                        <select class="bph-form-control" id="status" name="status" required style="color:black;">
                            <option value="">Pilih Status</option>
                            <option value="Sedang Dikirim">Sedang Dikirim</option>
                            <option value="Tiba Di Tujuan">Tiba di tujuan</option>
                        </select>
                        @error('status') <span class="bph-err">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="bph-form-group">
                        <label class="bph-form-label" for="nama_kurir">Nama Kurir</label>
                        <input type="text" class="bph-form-control" id="nama_kurir" name="nama_kurir" required>
                        @error('nama_kurir') <span class="bph-err">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bph-form-group">
                        <label class="bph-form-label" for="telpon_kurir">Telpon Kurir</label>
                        <input type="number" class="bph-form-control" id="telpon_kurir" name="telpon_kurir" required>
                        @error('telpon_kurir') <span class="bph-err">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="bukti_foto">Bukti Foto</label>
                <input type="file" class="bph-form-control" id="bukti_foto" name="bukti_foto">
                @error('bukti_foto') <span class="bph-err">{{ $message }}</span> @enderror
            </div>

            <div class="bph-form-group">
                <label class="bph-form-label" for="keterangan">Keterangan</label>
                <textarea class="bph-form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                @error('keterangan') <span class="bph-err">{{ $message }}</span> @enderror
            </div>

            <div class="bph-form-footer">
                <a href="{{ route('pengiriman.index') }}" class="bph-btn bph-btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                <button type="submit" class="bph-btn bph-btn-primary"><i class="bi bi-check-circle"></i> Simpan Pengiriman</button>
            </div>
        </form>
    </div>
</div>
@endsection
