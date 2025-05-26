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
                <div class="bg-white rounded shadow p-5">
                    <div class="row mb-4">
                        <div class="col-auto me-auto">
                            <h3 class="fw-bold text-success border-bottom pb-2">Tambah Metode Pembayaran</h3>
                        </div>
                    </div>

                    <form action="{{ route('metode_bayar.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="metode_pembayaran" class="form-label fw-semibold">Metode Pembayaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-sm" id="metode_pembayaran" name="metode_pembayaran" required>
                        </div>

                        <div class="mb-4">
                            <label for="tempat_bayar" class="form-label fw-semibold">Tempat Bayar <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-sm" id="tempat_bayar" name="tempat_bayar" required>
                        </div>

                        <div class="mb-4">
                            <label for="no_rekening" class="form-label fw-semibold">No. Rekening</label>
                            <input type="number" class="form-control shadow-sm" id="no_rekening" name="no_rekening">
                        </div>

                        <div class="mb-4">
                            <label for="logo" class="form-label fw-semibold">Logo Pembayaran</label>
                            <input type="file" class="form-control shadow-sm" id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Format: JPEG, PNG, JPG, GIF (Maks. 2MB)</small>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('metode_bayar.index') }}" class="btn btn-outline-danger me-2 px-4 py-2">Batal</a>
                            <button type="submit" class="btn px-4 py-2" style="background-color: #006400; color: white;">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
