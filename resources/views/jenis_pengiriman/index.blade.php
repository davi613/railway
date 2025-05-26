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

                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center shadow-sm">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">No.</th>
                                    <th scope="col">Jenis Kirim</th>
                                    <th scope="col">Nama Ekspedisi</th>
                                    <th scope="col">Ongkos Kirim</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Dibuat Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenisPengiriman as $no => $jp)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('jenis_pengiriman.edit', $jp->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit me-1"></i> Edit
                                                </a>
                                                <form action="{{ route('jenis_pengiriman.destroy', $jp->id) }}" method="POST" class="d-inline" id="delete-form-{{ $jp->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $jp->id }})">
                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $no + 1 }}.</th>
                                        <td>{{ ucfirst($jp->jenis_kirim) }}</td>
                                        <td>{{ $jp->nama_ekspedisi }}</td>
                                        <td>Rp {{ number_format($jp->ongkos_kirim, 0, ',', '.') }}</td>
                                        <td>
                                        @if($jp->logo_ekspedisi)
                                            <img src="{{ asset('storage/'.$jp->logo_ekspedisi) }}"
                                                alt="Logo"
                                                width="50"
                                                class="img-thumbnail rounded"
                                                style="cursor:pointer"
                                                onclick="showImageModal('{{ asset('storage/'.$jp->logo_ekspedisi) }}')">
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada logo</span>
                                        @endif
                                    </td>
                                        <td>{{ $jp->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

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
</script>


    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <!-- Bootstrap Modal (wajib agar modal jalan) -->

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data ini akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>

    <style>
        .swal2-actions {
            text-align: center;
        }
    </style>
@endsection
