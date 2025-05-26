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
            <div class="bg-white rounded-3 shadow p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold text-purple mb-1">
                            <i class="bi bi-truck me-2"></i>Manajemen Distributor
                        </h3>
                        <p class="text-muted small mb-0">Kelola data distributor dengan mudah dan cepat</p>
                    </div>
                    <a href="{{ route('distributor.create') }}" class="btn btn-success btn-sm px-3 py-2 shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Distributor
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead style="background-color:#e0d7f5;" class="text-dark">
                            <tr>
                                <th>Aksi</th>
                                <th>No.</th>
                                <th>Nama Distributor</th>
                                <th>Telepon</th>
                                <th class="text-start">Alamat</th>
                                <th>Dibuat</th>
                                <th>Terakhir Diupdate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($distributors as $no => $distributor)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <a style="background-color:orange; color:white;" href="{{ route('distributor.edit', $distributor->id) }}" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button style="background-color:red; color:white;" type="button" class="btn btn-outline-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $distributor->id }})">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                            <form id="delete-form-{{ $distributor->id }}" action="{{ route('distributor.destroy', $distributor->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $no + 1 }}</td>
                                    <td class="fw-semibold text-capitalize">{{ $distributor->nama_distributor }}</td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-telephone me-1"></i>{{ $distributor->telepon }}
                                        </span>
                                    </td>
                                    <td class="text-start">{{ $distributor->alamat }}</td>
                                    <td>{{ \Carbon\Carbon::parse($distributor->created_at)->format('d M Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($distributor->updated_at)->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted py-4">
                                        <i class="bi bi-box-seam fs-3 text-secondary"></i><br>
                                        Belum ada data distributor yang tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Distributor?',
            text: 'Data ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
