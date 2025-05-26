@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Jenis Obat</div>
                    <div class="col-auto">
                        <a href="{{ route('jenis_obat.create') }}" class="btn btn-success shadow-sm rounded">
                            <i class="fas fa-plus me-2"></i>Tambah Jenis
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
                    <table class="table table-hover table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Aksi</th>
                                <th scope="col">No.</th>
                                <th scope="col">Jenis Obat</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Dibuat Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenisObats as $no => $jenisObat)
                            <tr>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('jenis_obat.edit', $jenisObat->id) }}" class="btn btn-warning btn-sm rounded shadow-sm">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                        <form action="{{ route('jenis_obat.destroy', $jenisObat->id) }}" method="POST" class="d-inline form-hapus">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm">
                                                <i class="fas fa-trash-alt me-2"></i>Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <th scope="row">{{ $no + 1 }}.</th>
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
                            @endforeach
                        </tbody>
                    </table>
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
        z-index: 1000;
    }

    #previewModal img {
        max-width: 60%;   /* Ukuran gambar tidak lebih dari 60% lebar layar */
        max-height: 60%;  /* Ukuran gambar tidak lebih dari 60% tinggi layar */
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
