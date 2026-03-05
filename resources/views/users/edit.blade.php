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
        <h1 class="bph-page-title">Edit Data User</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('users.index') }}">Manajemen User</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>
    </div>
    <a href="{{ route('users.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-pencil-square"></i>
            Form Edit User
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('users.update', $users) }}" method="POST" id="frmUser">
            @method('PUT')
            @csrf

            <div class="bph-form-group">
                <label class="bph-label" for="name">Nama <span class="req">*</span></label>
                <input type="text" name="name" id="name" class="bph-input"
                    maxlength="30" placeholder="Masukkan nama lengkap"
                    value="{{ old('name', $users->name) }}">
                <div class="bph-form-hint">Maksimal 30 karakter.</div>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="email">Email <span class="req">*</span></label>
                <input type="email" name="email" id="email" class="bph-input"
                    placeholder="email@contoh.com"
                    value="{{ old('email', $users->email) }}">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="password">Password</label>
                <input type="password" name="password" id="password" class="bph-input"
                    placeholder="Kosongkan jika tidak ingin mengganti">
                <div class="bph-form-hint">Biarkan kosong jika tidak ingin mengubah password.</div>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="jabatan">Jabatan <span class="req">*</span></label>
                <select name="jabatan" id="jabatan" class="bph-select">
                    <option value="admin"    @selected(old('jabatan', $users->jabatan) === 'admin')>Admin</option>
                    <option value="apoteker" @selected(old('jabatan', $users->jabatan) === 'apoteker')>Apoteker</option>
                    <option value="karyawan" @selected(old('jabatan', $users->jabatan) === 'karyawan')>Karyawan</option>
                    <option value="kasir"    @selected(old('jabatan', $users->jabatan) === 'kasir')>Kasir</option>
                    <option value="pemilik"  @selected(old('jabatan', $users->jabatan) === 'pemilik')>Pemilik</option>
                </select>
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('users.index') }}" class="bph-btn bph-btn-outline">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="button" id="btnSave" class="bph-btn bph-btn-primary">
                    <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
window.addEventListener('load', function () {
    @if(session('success'))
        swal("Berhasil!", "{{ session('success') }}", "success");
    @endif
    @if ($errors->any())
        swal("Gagal!", "{{ $errors->first() }}", "error");
    @endif
});

document.getElementById('btnSave').addEventListener('click', function () {
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const jabatan = document.getElementById('jabatan');
    if (!name.value.trim()) { name.focus(); return swal("Error!", "Nama wajib diisi.", "error"); }
    if (!email.value.trim()) { email.focus(); return swal("Error!", "Email wajib diisi.", "error"); }
    if (!jabatan.value.trim()) { jabatan.focus(); return swal("Error!", "Pilih jabatan user.", "error"); }
    document.getElementById('frmUser').submit();
});
</script>
@endsection
