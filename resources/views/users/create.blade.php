@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container py-4 px-3 px-md-5">
    <div class="card shadow border-0">
        <div class="card-header bg-white border-bottom-0">
            <h4 class="fw-bold text-dark mb-0">Tambah Pengguna Baru</h4>
            <small class="text-muted">Isi data lengkap di bawah ini</small>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" id="frmUser">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" maxlength="30"
                        placeholder="Masukkan nama" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="email@contoh.com" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Minimal 8 karakter">
                </div>

                <div class="mb-4">
                    <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                    <select style="color:black" class="form-select" name="jabatan" id="jabatan">
                        <option disabled selected>-- Pilih Jabatan --</option>
                        <option value="admin" @selected(old('jabatan') === 'admin')>Admin</option>
                        <option value="apoteker" @selected(old('jabatan') === 'apoteker')>Apoteker</option>
                        <option value="karyawan" @selected(old('jabatan') === 'karyawan')>Karyawan</option>
                        <option value="kasir" @selected(old('jabatan') === 'kasir')>Kasir</option>
                        <option value="pemilik" @selected(old('jabatan') === 'pemilik')>Pemilik</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('users.index') }}" class="btn btn-outline-danger">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                    <button type="button" class="btn btn-primary" id="save">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            swal("Berhasil!", "{{ session('success') }}", "success");
        @endif

        @if($errors->any())
            swal("Gagal!", "{{ $errors->first() }}", "error");
        @endif
    });

    document.getElementById('save').addEventListener('click', function () {
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const jabatan = document.getElementById('jabatan');
        const form = document.getElementById('frmUser');

        if (!name.value.trim()) {
            name.focus();
            swal("Error!", "Nama wajib diisi", "error");
        } else if (!email.value.trim()) {
            email.focus();
            swal("Error!", "Email wajib diisi", "error");
        } else if (!jabatan.value || jabatan.selectedIndex === 0) {
            jabatan.focus();
            swal("Error!", "Jabatan harus dipilih", "error");
        } else {
            form.submit();
        }
    });
</script>
@endsection
