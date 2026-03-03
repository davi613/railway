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
            <div class="bg-white rounded shadow-sm p-4">
                <div class="row mb-4 align-items-center">
                    <div class="col-md-6 mb-3">
                        <h4 class="text-dark font-weight-bold">Daftar Obat</h4>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="{{ route('obat.create') }}" class="btn btn-success shadow-sm">
                            <i class="fas fa-plus me-2"></i>Tambah Obat
                        </a>
                    </div>
                </div>

                <form action="{{ route('obat.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau jenis obat..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>Aksi</th>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jenis Obat</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th>Deskripsi</th>
                                <th>Foto 1</th>
                                <th>Foto 2</th>
                                <th>Foto 3</th>
                                <th>Dibuat</th>
                                <th>Diperbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($obats as $no => $obat)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm text-white" style="background-color: orange;">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="d-inline form-hapus">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm text-white" style="background-color: #e3342f;">
                                                    <i class="fas fa-trash-alt me-1"></i>Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $obats->firstItem() + $no }}.</td>
                                    <td>{{ $obat->nama_obat }}</td>
                                    <td>{{ $obat->jenisObat->jenis }}</td>
                                    <td>{{ $obat->harga_jual }}</td>
                                    <td>{{ $obat->stok }}</td>
                                    <td>{{ \Str::limit($obat->deskripsi_obat, 20, '...') }}</td>
                                    <td>
                                        @if ($obat->foto1)
                                            <img src="{{ asset('storage/' . $obat->foto1) }}" alt="Foto 1" width="50" class="preview-img" data-src="{{ asset('storage/' . $obat->foto1) }}">
                                        @else - @endif
                                    </td>
                                    <td>
                                        @if ($obat->foto2)
                                            <img src="{{ asset('storage/' . $obat->foto2) }}" alt="Foto 2" width="50" class="preview-img" data-src="{{ asset('storage/' . $obat->foto2) }}">
                                        @else - @endif
                                    </td>
                                    <td>
                                        @if ($obat->foto3)
                                            <img src="{{ asset('storage/' . $obat->foto3) }}" alt="Foto 3" width="50" class="preview-img" data-src="{{ asset('storage/' . $obat->foto3) }}">
                                        @else - @endif
                                    </td>
                                    <td>{{ $obat->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $obat->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="12">Data tidak ditemukan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginate -->
                <div class="d-flex justify-content-center mt-3">
                    <div>
                        @if ($obats->hasPages())
                            <nav>
                                <ul class="pagination mb-0">
                                    @if ($obats->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $obats->previousPageUrl() }}">Previous</a></li>
                                    @endif

                                    @if ($obats->hasMorePages())
                                        <li class="page-item"><a class="page-link" href="{{ $obats->nextPageUrl() }}">Next</a></li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next</span></li>
                                    @endif
                                </ul>
                            </nav>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div id="previewModal" onclick="this.style.display='none'">
    <img id="modalImg" src="" alt="Preview">
</div>

<style>
    #previewModal {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 1050;
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
        img.addEventListener('click', function () {
            const src = this.getAttribute('data-src');
            const modal = document.getElementById('previewModal');
            const modalImg = document.getElementById('modalImg');
            modalImg.src = src;
            modal.style.display = 'flex';
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
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
