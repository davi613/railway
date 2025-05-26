@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('navbar')
    @include('be.navbar')
@endsection
@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-white shadow rounded h-100 p-4">
                    <div class="row mb-4 align-items-center">
                        <div class="col">
                            <h4 class="fw-bold text-dark">Manajemen User</h4>
                            <small class="text-muted">Daftar seluruh akun user beserta hak aksesnya</small>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('users.create') }}" class="btn btn-success shadow-sm d-flex align-items-center gap-2 px-3 py-2">
                                <i class="fas fa-plus-circle"></i> Tambah User
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark">
                                <tr class="text-center text-white">
                                    <th style="width: 130px;">Aksi</th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Dibuat</th>
                                    <th>Diperbarui</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $no => $user)
                                    <tr>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a style="background-color:orange; color:white;" href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning d-flex align-items-center gap-1">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button style="background-color:red; color:white;" type="button" class="btn btn-sm btn-outline-danger btn-delete d-flex align-items-center gap-1">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="text-center fw-semibold">{{ $no + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><span class="badge bg-primary">{{ $user->jabatan }}</span></td>
                                        <td style="color:white;" class="text-muted">{{ $user->created_at }}</td>
                                        <td style="color:white;" class="text-muted">{{ $user->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Pesan sukses
        document.addEventListener('DOMContentLoaded', function () {
            let pesan = "{{ session('pesan') }}";
            if (pesan.trim() !== '') {
                Swal.fire({
                    title: 'Sukses!',
                    text: pesan,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                });
            }
        });

        // Konfirmasi hapus
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data user akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
