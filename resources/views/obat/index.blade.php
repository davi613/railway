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
                <div class="bg-light rounded h-100 p-4">
                    <div class="row mb-5">
                        <div class="col-auto me-auto mb-4 h3 text-black-50">Daftar Obat</div>
                        <div class="col-auto">
                            <a href="{{ route('obat.create') }}" class="btn" style="background-color: #006400; color: white;">
                                <i class="fas fa-plus me-2"></i>Tambah Obat
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Aksi</th>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Obat</th>
                                    <th scope="col">Jenis Obat</th>
                                    <th scope="col">Harga Jual</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Foto 1</th>
                                    <th scope="col">Foto 2</th>
                                    <th scope="col">Foto 3</th>
                                    <th scope="col">Dibuat Pada</th>
                                    <th scope="col">Diperbarui Pada</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($obats as $no => $obat)
                                    <tr>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning btn-sm rounded shadow-sm">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                                <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="d-inline form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded shadow-sm">
                                                        <i class="fas fa-trash-alt me-2"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <th scope="row">{{ $no + 1 }}.</th>
                                        <td>{{ $obat->nama_obat }}</td>
                                        <td>{{ $obat->jenisObat->jenis }}</td>
                                        <td>{{ $obat->harga_jual }}</td>
                                        <td>{{ $obat->stok }}</td>
                                        <td>{{ \Str::limit($obat->deskripsi_obat, 20, '...') }}</td>
                                        <td>
                                            @if ($obat->foto1)
                                                <img src="{{ asset('storage/' . $obat->foto1) }}" alt="Foto 1" width="50" class="preview-img" data-src="{{ asset('storage/' . $obat->foto1) }}">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($obat->foto2)
                                                <img src="{{ asset('storage/' . $obat->foto2) }}" alt="Foto 2" width="50" class="preview-img" data-src="{{ asset('storage/' . $obat->foto2) }}">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($obat->foto3)
                                                <img src="{{ asset('storage/' . $obat->foto3) }}" alt="Foto 3" width="50" class="preview-img" data-src="{{ asset('storage/' . $obat->foto3) }}">
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $obat->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $obat->updated_at->format('d/m/Y H:i') }}</td>
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
