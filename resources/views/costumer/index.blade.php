@extends('be.master')

@section('sidebar')
@include('be.sidebar')
@endsection

@section('navbar')
@include('be.navbar')
@endsection
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@section('content')

<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-uppercase text-success">Daftar Pelanggan</h2>

    {{-- Search Form --}}
    <form action="{{ route('costumer.index') }}" method="GET" class="mb-4">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ $search ?? '' }}">
            <button class="btn btn-success" type="submit">
                <i class="bi bi-search" style="font-size: 1.2rem;"></i>
            </button>
        </div>
    </form>


    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    <div class="card shadow-sm rounded">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle">
                    <thead class="table-primary text-white">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telp</th>
                            <th>Alamat 1</th>
                            <th>Alamat 2</th>
                            <th>Alamat 3</th>
                            <th>Foto</th>
                            <th>KTP</th>
                        </tr>
                    </thead>

                            <tbody>
                                @if ($pelanggans->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center text-danger fw-bold">
                                            @if (request('search'))
                                                <em>Data tidak ditemukan untuk pencarian: <strong>"{{ request('search') }}"</strong></em>
                                            @else
                                                <em>Belum ada data pelanggan.</em>
                                            @endif
                                        </td>
                                    </tr>
                                @else
                                    {{-- @foreach($pelanggans as $pelanggan) --}}
                                    @foreach($pelanggans as $index => $pelanggan)
                                    <tr>
                                        <td>{{ $pelanggans->firstItem() + $index }}</td>
                                        <td>{{ $pelanggan->nama_pelanggan }}</td>
                                        <td>{{ $pelanggan->email }}</td>
                                        <td>{{ $pelanggan->no_telp }}</td>
                                        <td>
                                            <div class="text-start small">
                                                <div><strong>Alamat:</strong> {{ Str::limit($pelanggan->alamat1, 20) }}</div>
                                                <div><strong>Kota:</strong> {{ Str::limit($pelanggan->kota1, 15) }}</div>
                                                <div><strong>Provinsi:</strong> {{ Str::limit($pelanggan->provinsi1, 15) }}</div>
                                                <div><strong>Kode Pos:</strong> {{ $pelanggan->kodepos1 }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            @if ($pelanggan->alamat2)
                                            <div class="text-start small">
                                                <div><strong>Alamat:</strong> {{ Str::limit($pelanggan->alamat2, 20) }}</div>
                                                <div><strong>Kota:</strong> {{ Str::limit($pelanggan->kota2, 15) }}</div>
                                                <div><strong>Provinsi:</strong> {{ Str::limit($pelanggan->provinsi2, 15) }}</div>
                                                <div><strong>Kode Pos:</strong> {{ $pelanggan->kodepos2 }}</div>
                                            </div>
                                            @else
                                                <span class="badge bg-warning text-dark">Kosong</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($pelanggan->alamat3)
                                            <div class="text-start small">
                                                <div><strong>Alamat:</strong> {{ Str::limit($pelanggan->alamat3, 20) }}</div>
                                                <div><strong>Kota:</strong> {{ Str::limit($pelanggan->kota3, 15) }}</div>
                                                <div><strong>Provinsi:</strong> {{ Str::limit($pelanggan->provinsi3, 15) }}</div>
                                                <div><strong>Kode Pos:</strong> {{ $pelanggan->kodepos3 }}</div>
                                            </div>
                                            @else
                                                <span class="badge bg-warning text-dark">Kosong</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($pelanggan->foto)
                                                <button type="button" class="btn btn-sm btn-success lihat-ktp" data-img="{{ asset('storage/' . $pelanggan->foto) }}">
                                                    <i class="bi bi-eye-fill"></i> Lihat
                                                </button>
                                            @else
                                                <span class="badge bg-danger">Tidak Ada</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($pelanggan->url_ktp)
                                                <button type="button" class="btn btn-sm btn-info lihat-ktp" data-img="{{ asset('storage/' . $pelanggan->url_ktp) }}">
                                                    <i class="bi bi-eye-fill"></i> Lihat
                                                </button>
                                            @else
                                                <span class="badge bg-danger">Tidak Ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                </table>
                @if ($pelanggans->hasPages())
    <div class="d-flex justify-content-center mt-3">
        <ul class="pagination">
            {{-- Tombol Previous --}}
            @if ($pelanggans->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $pelanggans->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif

            {{-- Tombol Next --}}
            @if ($pelanggans->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $pelanggans->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </div>
@endif

            </div>
        </div>
    </div>
</div>

{{-- SweetAlert Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.lihat-ktp').forEach(button => {
        button.addEventListener('click', function () {
            const imageUrl = this.getAttribute('data-img');
            Swal.fire({
                title: 'Lihat Gambar',
                imageUrl: imageUrl,
                imageAlt: 'Gambar',
                showCloseButton: true,
                showConfirmButton: false,
                width: '600px',
            });
        });
    });
</script>

@endsection
