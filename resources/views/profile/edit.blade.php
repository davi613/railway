@extends('fe.master')

@section('content')
<div class="container py-5 mt-5"> {{-- Tambahkan margin atas agar tidak bentrok dengan navbar --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Profil</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nama_pelanggan" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                                    value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $pelanggan->email ?? '') }}" required>
                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                @if ($errors->has('email'))
                                    <script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: 'Email sudah terdaftar/Email has been used',
                                        });
                                    </script>
                                @endif


                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="no_telp" class="form-label">No. Telepon</label>
                                <input type="text" class="form-control" id="no_telp" name="no_telp"
                                    value="{{ old('no_telp', $pelanggan->no_telp) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label for="foto" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                                @if($pelanggan->foto)
                                    <small class="text-muted">
                                        Foto saat ini: 
                                        <a href="#" onclick="showFoto('{{ asset('storage/'.$pelanggan->foto) }}')">Lihat</a>
                                    </small>
                                @endif
                            </div>

                            <!-- Modal untuk Foto Profil -->
                            <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fotoModalLabel">Foto Profil</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img id="fotoImage" src="" alt="Foto Profil" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function showFoto(url) {
                                document.getElementById('fotoImage').src = url; // Set the image source
                                var myModal = new bootstrap.Modal(document.getElementById('fotoModal')); // Create a new modal instance
                                myModal.show(); // Show the modal
                            }
                            </script>

                            <div class="col-md-6">
                                <label for="url_ktp" class="form-label">Foto KTP</label>
                                <input type="file" class="form-control" id="url_ktp" name="url_ktp">
                                @if($pelanggan->url_ktp)
                                    <small class="text-muted">
                                        KTP saat ini: 
                                        <a href="#" onclick="showKTP('{{ asset('storage/'.$pelanggan->url_ktp) }}')">Lihat</a>
                                    </small>
                                @endif

                                <!-- Modal -->
                                <div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ktpModalLabel">KTP</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img id="ktpImage" src="" alt="KTP" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                function showKTP(url) {
                                    document.getElementById('ktpImage').src = url; // Set the image source
                                    var myModal = new bootstrap.Modal(document.getElementById('ktpModal')); // Create a new modal instance
                                    myModal.show(); // Show the modal
                                }
                                </script>
                            </div>
                        </div>

                        {{-- Alamat Utama --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Alamat 1 (Utama)</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="alamat1" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat1" name="alamat1"
                                        value="{{ old('alamat1', $pelanggan->alamat1) }}" required>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="kota1" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota1" name="kota1"
                                            value="{{ old('kota1', $pelanggan->kota1) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provinsi1" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi1" name="provinsi1"
                                            value="{{ old('provinsi1', $pelanggan->provinsi1) }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kodepos1" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodepos1" name="kodepos1"
                                            value="{{ old('kodepos1', $pelanggan->kodepos1) }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Alamat Alternatif 1 --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Alamat Alternatif 2 (Opsional)</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="alamat2" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat2" name="alamat2"
                                        value="{{ old('alamat2', $pelanggan->alamat2) }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="kota2" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota2" name="kota2"
                                            value="{{ old('kota2', $pelanggan->kota2) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provinsi2" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi2" name="provinsi2"
                                            value="{{ old('provinsi2', $pelanggan->provinsi2) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kodepos2" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodepos2" name="kodepos2"
                                            value="{{ old('kodepos2', $pelanggan->kodepos2) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Alamat Alternatif 2 --}}
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Alamat Alternatif 3 (Opsional)</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="alamat3" class="form-label">Alamat Lengkap</label>
                                    <input type="text" class="form-control" id="alamat3" name="alamat3"
                                        value="{{ old('alamat3', $pelanggan->alamat3) }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="kota3" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="kota3" name="kota3"
                                            value="{{ old('kota3', $pelanggan->kota3) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="provinsi3" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="provinsi3" name="provinsi3"
                                            value="{{ old('provinsi3', $pelanggan->provinsi3) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="kodepos3" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kodepos3" name="kodepos3"
                                            value="{{ old('kodepos3', $pelanggan->kodepos3) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button style="width: 180px; height: 50px;" type="submit" class="btn btn-primary me-2">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('profile.index') }}" class="btn btn-secondary" style="width:80px;height: 50px; line-height: 35px;">
                                Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
