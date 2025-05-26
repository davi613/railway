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
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-success text-white rounded-top-4">
                        <h4 class="mb-0">🛫 Tambah Jenis Pengiriman</h4>
                    </div>

                    <div class="card-body p-4 bg-white rounded-bottom-4">
                        <form action="{{ route('jenis_pengiriman.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="jenis_kirim" class="form-label fw-semibold text-dark">Jenis Kirim<span class="text-danger">*</span></label>
                                <select style="color:black;" class="form-select border-success" id="jenis_kirim" name="jenis_kirim" required>
                                    <option value="">-- Pilih Jenis Kirim --</option>
                                    <option value="ekonomi">Ekonomi</option>
                                    <option value="kargo">Kargo</option>
                                    <option value="regular">Regular</option>
                                    <option value="same day">Same Day</option>
                                    <option value="standar">Standar</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="nama_ekspedisi" class="form-label fw-semibold text-dark">Nama Ekspedisi<span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-success" id="nama_ekspedisi" name="nama_ekspedisi" required placeholder="Contoh: JNE, J&T, Tiki...">
                            </div>

                            <div class="mb-4">
                                <label for="ongkos_kirim" class="form-label fw-semibold text-dark">Ongkos Kirim<span class="text-danger">*</span></label>
                                <input type="number" class="form-control border-success" id="ongkos_kirim" name="ongkos_kirim" required placeholder="Masukkan nominal (contoh: 15000)">
                            </div>

                            <div class="mb-4">
                                <label for="logo_ekspedisi" class="form-label fw-semibold text-dark">Logo Ekspedisi<span class="text-danger">*</span></label>
                                <input type="file" class="form-control border-success" id="logo_ekspedisi" name="logo_ekspedisi" required accept="image/*">
                                <small class="form-text text-muted">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a style="color:black;" href="{{ route('jenis_pengiriman.index') }}" class="btn btn-outline-danger px-4">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success px-4">
                                    <i class="bi bi-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
