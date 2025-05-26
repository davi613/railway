@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Distributor Baru
                    </h5>
                    <a href="{{ route('distributor.index') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('distributor.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_distributor" class="form-label fw-semibold">Nama Distributor <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_distributor" name="nama_distributor" 
                                value="{{ old('nama_distributor') }}" required placeholder="Masukkan nama distributor">
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label fw-semibold">Telepon <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="telepon" name="telepon"
                                value="{{ old('telepon') }}" required pattern="\d{8,15}" 
                                maxlength="15" title="Masukkan 8-15 digit angka" placeholder="081234567890">
                            <div class="form-text">Harus angka (8-15 digit)</div>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i>Simpan
                            </button>
                            <a style="background-color:orange;" href="{{ route('distributor.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('telepon').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 15) {
            this.value = this.value.slice(0, 15);
        }
    });
</script>
@endsection
