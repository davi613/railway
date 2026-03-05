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
        <h1 class="bph-page-title">Edit Metode Pembayaran</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('metode_bayar.index') }}">Jenis Pembayaran</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>
    </div>
    <a href="{{ route('metode_bayar.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-pencil-square"></i>
            Form Edit Metode Pembayaran
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('metode_bayar.update', $metodeBayar->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bph-form-group">
                <label class="bph-label" for="metode_pembayaran">Metode Pembayaran <span class="req">*</span></label>
                <input type="text" class="bph-input" id="metode_pembayaran" name="metode_pembayaran"
                    value="{{ $metodeBayar->metode_pembayaran }}" required>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="tempat_bayar">Tempat Bayar <span class="req">*</span></label>
                <input type="text" class="bph-input" id="tempat_bayar" name="tempat_bayar"
                    value="{{ $metodeBayar->tempat_bayar }}" required>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="no_rekening">No. Rekening</label>
                <input type="text" class="bph-input" id="no_rekening" name="no_rekening"
                    value="{{ $metodeBayar->no_rekening }}">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="logo">Logo Pembayaran</label>
                <input type="file" class="bph-file-input" id="logo" name="logo" accept="image/*">
                <div class="bph-form-hint">Biarkan kosong jika tidak ingin mengubah logo.</div>

                @if($metodeBayar->url_logo)
                    <div style="margin-top:12px; display:flex; align-items:center; gap:14px; padding:14px; background:var(--bph-bg); border-radius:9px; border:1px solid var(--bph-border);">
                        <img src="{{ asset('storage/' . $metodeBayar->url_logo) }}" alt="Logo"
                            style="width:52px; height:52px; object-fit:contain; border-radius:8px; border:1px solid var(--bph-border); padding:4px; background:#fff;">
                        <div>
                            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:var(--bph-muted);">Logo Saat Ini</div>
                            <div style="font-weight:700; color:var(--bph-dark); margin-top:2px;">{{ $metodeBayar->metode_pembayaran }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('metode_bayar.index') }}" class="bph-btn bph-btn-outline">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="bph-btn bph-btn-primary">
                    <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
