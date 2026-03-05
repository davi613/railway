@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('navbar')
    @include('be.navbar')
@endsection

@section('content')

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Tambah Jenis Pengiriman</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('jenis_pengiriman.index') }}">Jenis Pengiriman</a>
            <span class="sep">/</span>
            <span>Tambah</span>
        </div>
    </div>
    <a href="{{ route('jenis_pengiriman.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-plus-circle-fill"></i>
            Form Tambah Jenis Pengiriman
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('jenis_pengiriman.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bph-form-group">
                <label class="bph-label" for="jenis_kirim">Jenis Kirim <span class="req">*</span></label>
                <select class="bph-select" id="jenis_kirim" name="jenis_kirim" required>
                    <option value="">— Pilih Jenis Kirim —</option>
                    <option value="ekonomi">Ekonomi</option>
                    <option value="kargo">Kargo</option>
                    <option value="regular">Regular</option>
                    <option value="same day">Same Day</option>
                    <option value="standar">Standar</option>
                </select>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="nama_ekspedisi">Nama Ekspedisi <span class="req">*</span></label>
                <input type="text" class="bph-input" id="nama_ekspedisi" name="nama_ekspedisi"
                    required placeholder="Contoh: JNE, J&T, Tiki, SiCepat...">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="ongkos_kirim">Ongkos Kirim <span class="req">*</span></label>
                <input type="number" class="bph-input" id="ongkos_kirim" name="ongkos_kirim"
                    required placeholder="Masukkan nominal (contoh: 15000)">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="logo_ekspedisi">Logo Ekspedisi <span class="req">*</span></label>
                <input type="file" class="bph-file-input" id="logo_ekspedisi" name="logo_ekspedisi"
                    required accept="image/*">
                <div class="bph-form-hint">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</div>
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('jenis_pengiriman.index') }}" class="bph-btn bph-btn-outline">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="bph-btn bph-btn-primary">
                    <i class="bi bi-check-circle-fill"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
