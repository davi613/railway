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
        <h1 class="bph-page-title">Tambah Metode Pembayaran</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('metode_bayar.index') }}">Jenis Pembayaran</a>
            <span class="sep">/</span>
            <span>Tambah</span>
        </div>
    </div>
    <a href="{{ route('metode_bayar.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-plus-circle-fill"></i>
            Form Tambah Metode Pembayaran
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('metode_bayar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bph-form-group">
                <label class="bph-label" for="metode_pembayaran">Metode Pembayaran <span class="req">*</span></label>
                <input type="text" class="bph-input" id="metode_pembayaran" name="metode_pembayaran"
                    required placeholder="Contoh: Transfer Bank, COD, QRIS...">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="tempat_bayar">Tempat Bayar <span class="req">*</span></label>
                <input type="text" class="bph-input" id="tempat_bayar" name="tempat_bayar"
                    required placeholder="Contoh: BCA, Mandiri, BRI...">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="no_rekening">No. Rekening</label>
                <input type="number" class="bph-input" id="no_rekening" name="no_rekening"
                    placeholder="Masukkan nomor rekening">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="logo">Logo Pembayaran</label>
                <input type="file" class="bph-file-input" id="logo" name="logo" accept="image/*">
                <div class="bph-form-hint">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</div>
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('metode_bayar.index') }}" class="bph-btn bph-btn-outline">
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
