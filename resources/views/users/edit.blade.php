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
                <div class="bg-white shadow-sm border rounded p-5">
                    <div class="mb-4 border-bottom pb-2">
                        <h3 class="fw-bold text-dark mb-1">Edit Data User</h3>
                        <small class="text-muted">Perbarui informasi akun user di bawah ini</small>
                    </div>

                    <form action="{{ route('users.update', $users) }}" method="POST" id="frmUser">
                        @method('PUT')
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold">Nama</label>
                            <input type="text" name="name" id="name" class="form-control shadow-sm" maxlength="30"
                                value="{{ old('name', $users->name) }}">
                            <div class="form-text text-secondary">Maksimal 30 karakter.</div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email" class="form-control shadow-sm"
                                value="{{ old('email', $users->email) }}">
                            <div class="form-text text-secondary">Harus unik dan valid.</div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" id="password" class="form-control shadow-sm">
                            <div class="form-text text-secondary">Kosongkan jika tidak ingin mengganti password.</div>
                        </div>

                        <div class="mb-4">
                            <label  for="jabatan" class="form-label fw-semibold">Jabatan</label>
                            <select style="color:black;" name="jabatan" id="jabatan" class="form-select shadow-sm">
                                <option style="color:black;" value="admin" @selected(old('jabatan', $users->jabatan) === 'admin')>Admin</option>
                                <option style="color:black;" value="apoteker" @selected(old('jabatan', $users->jabatan) === 'apoteker')>Apoteker</option>
                                <option style="color:black;" value="karyawan" @selected(old('jabatan', $users->jabatan) === 'karyawan')>Karyawan</option>
                                <option style="color:black;" value="kasir" @selected(old('jabatan', $users->jabatan) === 'kasir')>Kasir</option>
                                <option style="color:black;" value="pemilik" @selected(old('jabatan', $users->jabatan) === 'pemilik')>Pemilik</option>
                            </select>
                            <div class="form-text text-secondary">Pilih salah satu jabatan user.</div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a style="background-color:red; color:white;" href="{{ route('users.index') }}" class="btn btn-outline-danger shadow-sm">
                                <i class="fas fa-times me-2"></i> Batal
                            </a>
                            <button type="button" id="save" class="btn shadow-sm" style="background-color: #0f5132; color: white;">
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
        const btnSimpan = document.getElementById('save');
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const jabatan = document.getElementById('jabatan');
        const form = document.getElementById('frmUser');

        function tampil_pesan() {
            @if(session('success'))
                swal("Sukses!", "{{ session('success') }}", "success");
            @endif

            @if ($errors->any())
                @php $errorMessage = $errors->first(); @endphp
                swal("Error!", "{{ $errorMessage }}", "error");
            @endif
        }

        function simpan() {
            if (name.value.trim() === '') {
                name.focus();
                swal("Data Tidak Valid!", "Nama harus diisi!", "error");
            } else if (email.value.trim() === '') {
                email.focus();
                swal("Data Tidak Valid!", "Email harus diisi!", "error");
            } else if (jabatan.value.trim() === '') {
                jabatan.focus();
                swal("Data Tidak Valid!", "Pilih jabatan user!", "error");
            } else {
                form.submit();
            }
        }

        btnSimpan.addEventListener('click', simpan);
        window.addEventListener('load', tampil_pesan);
    </script>
@endsection
