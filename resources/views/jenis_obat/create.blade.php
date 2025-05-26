@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Jenis Obat Create</div>
                </div>

                {{-- <form action="{{ route('jenis_obat.store') }}" method="POST" enctype="multipart/form-data"> --}}
                <form id="formJenisObat" action="{{ route('jenis_obat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Obat</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi_jenis" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_jenis" name="deskripsi_jenis" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image_url" name="image_url">
                    </div>

                    <div class="text-end">
                        <a href="{{ route('jenis_obat.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn" style="background-color: #006400; color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formJenisObat');
    const imageInput = document.getElementById('image_url');

    form.addEventListener('submit', function (e) {
        // Cek apakah file gambar belum diisi
        if (!imageInput.value) {
            e.preventDefault(); // Hentikan form dari submit
            Swal.fire({
                icon: 'error',
                title: 'Gambar belum diisi',
                text: 'Silakan upload gambar terlebih dahulu sebelum menyimpan.',
                confirmButtonColor: '#006400'
            });
        }
    });
});
</script>

@endsection