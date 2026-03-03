@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-white shadow rounded h-100 p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                    <h3 class="text-dark">Jenis Obat</h3>
                    <a href="{{ route('jenis_obat.create') }}" class="btn btn-orange shadow-sm rounded mb-2 mb-md-0">
                        <i class="fas fa-plus me-2"></i>Tambah Jenis
                    </a>
                </div>

                {{-- Search --}}
                <form method="GET" action="{{ route('jenis_obat.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Cari jenis atau deskripsi...">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search me-1"></i> Cari</button>
                        </div>
                    </div>
                </form>

                {{-- Notifikasi --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Aksi</th>
                                <th>No.</th>
                                <th>Jenis Obat</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jenisObats as $no => $jenisObat)
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('jenis_obat.edit', $jenisObat->id) }}" class="btn btn-warning btn-sm rounded shadow-sm">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <form action="{{ route('jenis_obat.destroy', $jenisObat->id) }}" method="POST" class="d-inline form-hapus">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm">
                                                <i class="fas fa-trash-alt me-1"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td>{{ $jenisObats->firstItem() + $no }}.</td>
                                <td>{{ $jenisObat->jenis }}</td>
                                <td>{{ $jenisObat->deskripsi_jenis ?? '-' }}</td>
                                <td>
                                    @if($jenisObat->image_url)
                                        <img src="{{ asset('storage/'.$jenisObat->image_url) }}" alt="{{ $jenisObat->jenis }}" width="50" class="preview-img" data-src="{{ asset('storage/'.$jenisObat->image_url) }}">
                                    @else
                                        <span class="text-muted">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>{{ $jenisObat->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-muted">Tidak ada data ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($jenisObats->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        <nav>
                            <ul class="pagination mb-0">
                                @if ($jenisObats->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $jenisObats->previousPageUrl() }}">Previous</a></li>
                                @endif

                                @if ($jenisObats->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $jenisObats->nextPageUrl() }}">Next</a></li>
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

{{-- Preview Modal --}}
<div id="previewModal" onclick="this.style.display='none'">
    <img id="modalImg" src="" alt="Preview">
</div>

<style>
    .btn-orange {
        background-color: #fd7e14;
        color: white;
    }
    .btn-orange:hover {
        background-color: #e86b00;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    .btn-danger:hover {
        background-color: #c82333 !important;
    }

    #previewModal {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    #previewModal img {
        max-width: 60%;
        max-height: 60%;
        border: 4px solid white;
        border-radius: 10px;
    }
    #previewModal:after {
        content: "×";
        position: absolute;
        top: 20px;
        right: 30px;
        color: white;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<script>
    document.querySelectorAll('.preview-img').forEach(img => {
        img.addEventListener('click', function() {
            const src = this.getAttribute('data-src');
            const modal = document.getElementById('previewModal');
            const modalImg = document.getElementById('modalImg');
            modalImg.src = src;
            modal.style.display = 'flex';
        });
    });

    document.querySelector('#previewModal').addEventListener('click', function() {
        this.style.display = 'none';
    });
</script>

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
