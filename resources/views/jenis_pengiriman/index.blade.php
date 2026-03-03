@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-white rounded shadow p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-success border-bottom pb-2 mb-0">Daftar Jenis Pengiriman</h3>
                    <a href="{{ route('jenis_pengiriman.create') }}" class="btn btn-success px-4 py-2 shadow-sm">
                        <i class="fas fa-plus me-2"></i>Tambah Jenis
                    </a>
                </div>

                <!-- Search Bar -->
                <form method="GET" action="{{ route('jenis_pengiriman.index') }}" class="mb-4">
                    <div class="input-group shadow-sm">
                        <input type="text" name="search" class="form-control border-success" placeholder="Cari jenis kirim atau nama ekspedisi..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle text-center">
                        <thead class="table-success">
                            <tr>
                                <th>Aksi</th>
                                <th>No.</th>
                                <th>Jenis Kirim</th>
                                <th>Nama Ekspedisi</th>
                                <th>Ongkos Kirim</th>
                                <th>Logo</th>
                                <th>Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenisPengiriman as $no => $jp)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('jenis_pengiriman.edit', $jp->id) }}" class="btn btn-sm btn-warning text-white">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('jenis_pengiriman.destroy', $jp->id) }}" method="POST" class="d-inline" id="delete-form-{{ $jp->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger text-white" onclick="confirmDelete({{ $jp->id }})">
                                                    <i class="fas fa-trash-alt me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $no + $jenisPengiriman->firstItem() }}.</td>
                                    <td>{{ ucfirst($jp->jenis_kirim) }}</td>
                                    <td>{{ $jp->nama_ekspedisi }}</td>
                                    <td>Rp {{ number_format($jp->ongkos_kirim, 0, ',', '.') }}</td>
                                    <td>
                                        @if($jp->logo_ekspedisi)
                                            <img src="{{ asset('storage/'.$jp->logo_ekspedisi) }}" alt="Logo" width="50" class="img-thumbnail rounded" style="cursor:pointer" onclick="showImageModal('{{ asset('storage/'.$jp->logo_ekspedisi) }}')">
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada logo</span>
                                        @endif
                                    </td>
                                    <td>{{ $jp->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="alert alert-warning text-center mb-0">@if(request('search')) Data dengan kata kunci "<strong>{{ request('search') }}</strong>" tidak ditemukan.@else Tidak ada data tersedia.@endif</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Custom Pagination -->
                @if ($jenisPengiriman->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        <ul class="pagination mb-0">
                            @if ($jenisPengiriman->onFirstPage())
                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jenisPengiriman->previousPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}">Previous</a>
                                </li>
                            @endif

                            @if ($jenisPengiriman->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $jenisPengiriman->nextPageUrl() }}{{ request('search') ? '&search=' . request('search') : '' }}">Next</a>
                                </li>
                            @else
                                <li class="page-item disabled"><span class="page-link">Next</span></li>
                            @endif
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

<!-- Modal Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Preview" class="img-fluid rounded shadow" style="max-width: 90%; max-height: 80vh;">
                <button type="button" class="btn btn-sm btn-danger mt-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showImageModal(imageUrl) {
        document.getElementById('modalImage').src = imageUrl;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#e60000',
            cancelButtonColor: '#aaa',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>

<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>

<style>
    .pagination {
        justify-content: center !important;
    }
    .btn-warning {
        background-color: orange !important;
        border-color: orange !important;
    }
    .btn-danger {
        background-color: #e60000 !important;
        border-color: #e60000 !important;
    }
</style>
@endsection
