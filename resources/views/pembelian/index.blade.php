@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm border">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-8">
                        <h4 class="text-dark">Silahkan Tambahkan Data Pembelian Dari Distributor</h4>
                    </div>
                    <div class="col-md-4 text-end">
                        <a href="{{ route('pembelian.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Tambah Pembelian
                        </a>
                    </div>
                </div>

                <form method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari data pembelian..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-hover shadow-sm">
                        <thead class="table-secondary text-center">
                            <tr>
                                <th>Aksi</th>
                                <th>No.</th>
                                <th>No Nota</th>
                                <th>Tanggal Pembelian</th>
                                <th>Total Bayar</th>
                                <th>Distributor</th>
                                <th>Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pembelians as $no => $pembelian)
                            <tr>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $no + $pembelians->firstItem() }}.</td>
                                <td>{{ $pembelian->nonota }}</td>
                                <td>{{ date('d-m-Y', strtotime($pembelian->tgl_pembelian)) }}</td>
                                <td>Rp {{ number_format($pembelian->total_bayar, 2, ',', '.') }}</td>
                                <td>{{ $pembelian->distributor->nama_distributor }}</td>
                                <td>{{ $pembelian->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada data pembelian.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($pembelians->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <nav>
                            <ul class="pagination">
                                @if ($pembelians->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $pembelians->previousPageUrl() }}">Previous</a></li>
                                @endif

                                @if ($pembelians->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $pembelians->nextPageUrl() }}">Next</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
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