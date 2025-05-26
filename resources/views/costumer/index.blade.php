@extends('be.master')

@section('sidebar')
@include('be.sidebar')
@endsection

@section('navbar')
@include('be.navbar')
@endsection

@section('content')

<div class="container mt-5">
    <h2 class="mb-4 fw-bold text-uppercase text-success">Daftar Pelanggan</h2>

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
                    <thead style="background-color: #0d6efd; color: white;">
                        <tr>
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
                        @forelse($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->no_telp }}</td>
                            <td>
                                <div class="text-start">
                                    <div><strong>Alamat:</strong> {{ Str::limit($pelanggan->alamat1, 20) }}</div>
                                    <div><strong>Kota:</strong> {{ Str::limit($pelanggan->kota1, 15) }}</div>
                                    <div><strong>Provinsi:</strong> {{ Str::limit($pelanggan->provinsi1, 15) }}</div>
                                    <div><strong>Kode Pos:</strong> {{ $pelanggan->kodepos1 }}</div>
                                </div>
                            </td>
                            <td>
                                @if ($pelanggan->alamat2)
                                <div class="text-start">
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
                                <div class="text-start">
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
                                    <button type="button" class="btn btn-sm btn-success lihat-ktp" data-img="{{ asset('storage/' . $pelanggan->foto) }}">Lihat</button>
                                @else
                                    <span class="badge bg-danger">Tidak Ada</span>
                                @endif
                            </td>
                            <td>
                                @if($pelanggan->url_ktp)
                                    <button type="button" class="btn btn-sm btn-info lihat-ktp" data-img="{{ asset('storage/' . $pelanggan->url_ktp) }}">Lihat</button>
                                @else
                                    <span class="badge bg-danger">Tidak Ada</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-danger fw-bold">Belum ada data pelanggan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.delete-button').forEach(button => {
        button.addEventListener('click', function () {
            let form = this.closest('form');
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    document.querySelectorAll('.lihat-ktp').forEach(button => {
        button.addEventListener('click', function () {
            const imageUrl = this.getAttribute('data-img');
            Swal.fire({
                title: 'Foto',
                imageUrl: imageUrl,
                imageAlt: 'KTP Pelanggan',
                showCloseButton: true,
                showConfirmButton: false,
                width: '600px',
            });
        });
    });
</script>

@endsection
