@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-white shadow rounded p-5">
                <div class="mb-4 border-bottom pb-2">
                    <h3 class="fw-bold text-dark">Edit Data User</h3>
                    <small class="text-muted">Perbarui informasi akun user di bawah ini</small>
                </div>

                <form action="{{ route('users.update', $users) }}" method="POST" id="frmUser">
                    @method('PUT')
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" id="name" class="form-control shadow-sm" maxlength="30"
                            value="{{ old('name', $users->name) }}">
                        <div class="form-text">Maksimal 30 karakter.</div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" id="email" class="form-control shadow-sm"
                            value="{{ old('email', $users->email) }}">
                        <div class="form-text">Harus unik dan valid.</div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="password" class="form-control shadow-sm">
                        <div class="form-text">Kosongkan jika tidak ingin mengganti password.</div>
                    </div>

                    <div class="mb-4">
                        <label for="jabatan" class="form-label fw-semibold">Jabatan</label>
                        <select name="jabatan" id="jabatan" class="form-select shadow-sm text-dark">
                            <option value="admin" @selected(old('jabatan', $users->jabatan) === 'admin')>Admin</option>
                            <option value="apoteker" @selected(old('jabatan', $users->jabatan) === 'apoteker')>Apoteker</option>
                            <option value="karyawan" @selected(old('jabatan', $users->jabatan) === 'karyawan')>Karyawan</option>
                            <option value="kasir" @selected(old('jabatan', $users->jabatan) === 'kasir')>Kasir</option>
                            <option value="pemilik" @selected(old('jabatan', $users->jabatan) === 'pemilik')>Pemilik</option>
                        </select>
                        <div class="form-text">Pilih salah satu jabatan user.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-danger shadow-sm">
                            <i class="fas fa-times me-2"></i> Batal
                        </a>
                        <button type="button" id="save" class="btn btn-success shadow-sm">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    const form = document.getElementById('frmUser');
    const btnSimpan = document.getElementById('save');
    const name = document.getElementById('name');
    const email = document.getElementById('email');
    const jabatan = document.getElementById('jabatan');

    function tampil_pesan() {
        @if(session('success'))
            swal("Berhasil!", "{{ session('success') }}", "success");
        @endif

        @if ($errors->any())
            swal("Gagal!", "{{ $errors->first() }}", "error");
        @endif
    }

    function simpan() {
        if (name.value.trim() === '') {
            name.focus();
            return swal("Error!", "Nama wajib diisi.", "error");
        } else if (email.value.trim() === '') {
            email.focus();
            return swal("Error!", "Email wajib diisi.", "error");
        } else if (jabatan.value.trim() === '') {
            jabatan.focus();
            return swal("Error!", "Pilih jabatan user.", "error");
        } else {
            form.submit();
        }
    }

    btnSimpan.addEventListener('click', simpan);
    window.addEventListener('load', tampil_pesan);
</script>
@endsection
