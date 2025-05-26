@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Jenis Obat Edit</div>
                </div>

                <form action="{{ route('jenis_obat.update', $jenisObat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis Obat</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $jenisObat->jenis }}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi_jenis" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi_jenis" name="deskripsi_jenis" rows="3">{{ $jenisObat->deskripsi_jenis }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image_url" name="image_url">
                        @if($jenisObat->image_url)
                            <img src="{{ asset('storage/'.$jenisObat->image_url) }}" alt="{{ $jenisObat->jenis }}" width="100" class="mt-2">
                            <small class="text-muted d-block">Biarkan kosong jika tidak ingin mengubah gambar</small>
                        @endif
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
@endsection