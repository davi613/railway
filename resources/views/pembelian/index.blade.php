@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4 shadow-sm">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Data Pembelian</div>
                    <div class="col-auto">
                        <a href="{{ route('pembelian.create') }}" class="btn" style="background-color: #006400; color: white;">
                            <i class="fas fa-plus me-2"></i>Tambah Pembelian
                        </a>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover shadow-sm">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Aksi</th>
                                <th scope="col">No.</th>
                                <th scope="col">No Nota</th>
                                <th scope="col">Tanggal Pembelian</th>
                                <th scope="col">Total Bayar</th>
                                <th scope="col">Distributor</th>
                                <th scope="col">Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembelians as $no => $pembelian)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="btn btn-warning btn-sm rounded shadow-sm">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                        <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <th scope="row">{{ $no + 1 }}.</th>
                                <td>{{ $pembelian->nonota }}</td>
                                <td>{{ date('d-m-Y', strtotime($pembelian->tgl_pembelian)) }}</td>
                                <td>Rp {{ number_format($pembelian->total_bayar, 2, ',', '.') }}</td>
                                <td>{{ $pembelian->distributor->nama_distributor }}</td>
                                <td>{{ $pembelian->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                confirmButtonColor: '#d33',
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
