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
                <div class="p-4 rounded shadow-sm" style="background-color: #ffffff; border: 1px solid #ced4da;">
                    <div class="row mb-4">
                        <div class="col">
                            <h3 class="fw-bold text-dark">Create New User</h3>
                            <hr>
                        </div>
                    </div>

                    <form action="{{ route('users.store') }}" method="POST" id="frmUser">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-dark">Name</label>
                            <input class="form-control" name="name" id="name" maxlength="30" type="text"
                                placeholder="Enter full name" value="{{ old('name') }}">
                            <small class="form-text text-danger">* Maximal 30 characters</small>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-dark">Email</label>
                            <input class="form-control" name="email" id="email" type="email"
                                placeholder="example@mail.com" value="{{ old('email') }}">
                            <small class="form-text text-danger">* Must be unique and valid</small>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-dark">Password</label>
                            <input class="form-control" name="password" id="password" type="password"
                                placeholder="Enter secure password">
                            <small class="form-text text-danger">* At least 8 characters</small>
                        </div>

                        <div class="mb-4">
                            <label for="jabatan" class="form-label fw-semibold text-dark">Jabatan</label>
                            <select class="form-select" id="jabatan" name="jabatan">
                                <option disabled selected>-- Select Jabatan --</option>
                                <option value="admin" @selected(old('jabatan') === 'admin')>Admin</option>
                                <option value="apoteker" @selected(old('jabatan') === 'apoteker')>Apoteker</option>
                                <option value="karyawan" @selected(old('jabatan') === 'karyawan')>Karyawan</option>
                                <option value="kasir" @selected(old('jabatan') === 'kasir')>Kasir</option>
                                <option value="pemilik" @selected(old('jabatan') === 'pemilik')>Pemilik</option>
                            </select>
                            <small class="form-text text-danger">* Required</small>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('users.index') }}" class="btn btn-danger me-2">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success" id="save">
                                <i class="fas fa-save me-1"></i> Save
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

        async function tampil_pesan() {
            @if(session('success'))
                await swal("Success!", "{{ session('success') }}", "success");
            @endif

            @if ($errors->any())
                await swal("Error!", "{{ $errors->first() }}", "error");
            @endif
        }

        async function simpan() {
            if (name.value.trim() === '') {
                name.focus();
                return await swal("Invalid Data!", "Name is required!", "error");
            } else if (email.value.trim() === '') {
                email.focus();
                return await swal("Invalid Data!", "Email is required!", "error");
            } else if (jabatan.value.trim() === '') {
                jabatan.focus();
                return await swal("Invalid Data!", "Jabatan must be selected!", "error");
            } else {
                form.submit();
            }
        }

        btnSimpan.onclick = async function(e) {
            e.preventDefault();
            await simpan();
        };

        window.onload = async function () {
            await tampil_pesan();
        };
    </script>
@endsection
