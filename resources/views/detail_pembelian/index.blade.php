@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4 shadow-sm">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Detail Pembelian</div>
                    <div class="col-auto">
                        <a href="{{ route('detail_pembelian.create') }}" class="btn" style="background-color: #006400; color: white;">
                            <i class="fas fa-plus me-2"></i>Tambah Detail
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
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Jumlah Beli</th>
                                <th scope="col">Harga Beli</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $no => $detail)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('detail_pembelian.edit', $detail->id) }}" class="btn btn-warning btn-sm rounded shadow-sm">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                        <form action="{{ route('detail_pembelian.destroy', $detail->id) }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <th scope="row">{{ $no + 1 }}.</th>
                                <td>{{ $detail->pembelian->nonota }}</td>
                                <td>{{ $detail->obat->nama_obat }}</td>
                                <td>{{ $detail->jumlah_beli }}</td>
                                <td>Rp {{ number_format($detail->harga_beli, 2, ',', '.') }}</td>
                                <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
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
