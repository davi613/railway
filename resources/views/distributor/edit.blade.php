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
        <h1 class="bph-page-title">Edit Distributor</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('distributor.index') }}">Distributor</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>
    </div>
    <a href="{{ route('distributor.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-pencil-square"></i>
            Form Edit Distributor
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('distributor.update', $distributor->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="bph-form-group">
                <label class="bph-label" for="nama_distributor">Nama Distributor <span class="req">*</span></label>
                <input type="text" name="nama_distributor" id="nama_distributor" class="bph-input"
                    value="{{ old('nama_distributor', $distributor->nama_distributor) }}"
                    placeholder="Masukkan nama distributor" required>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="telepon">Telepon <span class="req">*</span></label>
                <input type="number" name="telepon" id="telepon" class="bph-input"
                    value="{{ old('telepon', $distributor->telepon) }}"
                    required maxlength="15" placeholder="081234567890">
                <div class="bph-form-hint">Format angka 8–15 digit.</div>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="alamat">Alamat <span class="req">*</span></label>
                <textarea name="alamat" id="alamat" class="bph-textarea" rows="3" required
                    placeholder="Masukkan alamat lengkap">{{ old('alamat', $distributor->alamat) }}</textarea>
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('distributor.index') }}" class="bph-btn bph-btn-outline">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="bph-btn bph-btn-primary">
                    <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('telepon').addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);
});
</script>
@endsection
