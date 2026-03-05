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
        <h1 class="bph-page-title">Tambah User Baru</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('users.index') }}">Manajemen User</a>
            <span class="sep">/</span>
            <span>Tambah</span>
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-person-plus-fill"></i>
            Form Tambah User
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('users.store') }}" method="POST" id="frmUser">
            @csrf

            <div class="bph-form-group">
                <label class="bph-label" for="name">Nama <span class="req">*</span></label>
                <input type="text" class="bph-input" id="name" name="name"
                    maxlength="30" placeholder="Masukkan nama lengkap"
                    value="{{ old('name') }}">
                <div class="bph-form-hint">Maksimal 30 karakter.</div>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="email">Email <span class="req">*</span></label>
                <input type="email" class="bph-input" id="email" name="email"
                    placeholder="email@contoh.com" value="{{ old('email') }}">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="password">Password <span class="req">*</span></label>
                <input type="password" class="bph-input" id="password" name="password"
                    placeholder="Minimal 8 karakter">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="jabatan">Jabatan <span class="req">*</span></label>
                <select class="bph-select" name="jabatan" id="jabatan">
                    <option disabled selected value="">-- Pilih Jabatan --</option>
                    <option value="admin"    @selected(old('jabatan') === 'admin')>Admin</option>
                    <option value="apoteker" @selected(old('jabatan') === 'apoteker')>Apoteker</option>
                    <option value="karyawan" @selected(old('jabatan') === 'karyawan')>Karyawan</option>
                    <option value="kasir"    @selected(old('jabatan') === 'kasir')>Kasir</option>
                    <option value="pemilik"  @selected(old('jabatan') === 'pemilik')>Pemilik</option>
                </select>
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('users.index') }}" class="bph-btn bph-btn-outline">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="button" class="bph-btn bph-btn-primary" id="btnSave">
                    <i class="bi bi-check-circle-fill"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('success'))
        swal("Berhasil!", "{{ session('success') }}", "success");
    @endif
    @if($errors->any())
        swal("Gagal!", "{{ $errors->first() }}", "error");
    @endif

    document.getElementById('btnSave').addEventListener('click', function () {
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const jabatan = document.getElementById('jabatan');
        if (!name.value.trim()) { name.focus(); return swal("Error!", "Nama wajib diisi", "error"); }
        if (!email.value.trim()) { email.focus(); return swal("Error!", "Email wajib diisi", "error"); }
        if (!jabatan.value || jabatan.selectedIndex === 0) { jabatan.focus(); return swal("Error!", "Jabatan harus dipilih", "error"); }
        document.getElementById('frmUser').submit();
    });
});
</script>
@endsection
