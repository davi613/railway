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
                        <div class="col-auto me-auto mb-4 h3 text-black-50">Edit Obat</div>
                    </div>

                    <form action="{{ route('obat.update', $obat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_obat" class="form-label">Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{ $obat->nama_obat }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="idjenis" class="form-label">Jenis Obat</label>
                            <select style="color:black;" class="form-select" id="idjenis" name="idjenis" required>
                                @foreach ($jenisObats as $jenisObat)
                                    <option value="{{ $jenisObat->id }}" {{ $obat->idjenis == $jenisObat->id ? 'selected' : '' }}>
                                        {{ $jenisObat->jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $obat->harga_jual }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" value="{{ $obat->stok }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi_obat" class="form-label">Deskripsi Obat</label>
                            <textarea class="form-control" id="deskripsi_obat" name="deskripsi_obat">{{ $obat->deskripsi_obat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto1" class="form-label">Foto 1</label>
                            <input type="file" class="form-control" id="foto1" name="foto1">
                            @if ($obat->foto1)
                                <img src="{{ asset('storage/' . $obat->foto1) }}" alt="Foto 1" width="100" class="mt-2">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="foto2" class="form-label">Foto 2</label>
                            <input type="file" class="form-control" id="foto2" name="foto2">
                            @if ($obat->foto2)
                                <img src="{{ asset('storage/' . $obat->foto2) }}" alt="Foto 2" width="100" class="mt-2">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="foto3" class="form-label">Foto 3</label>
                            <input type="file" class="form-control" id="foto3" name="foto3">
                            @if ($obat->foto3)
                                <img src="{{ asset('storage/' . $obat->foto3) }}" alt="Foto 3" width="100" class="mt-2">
                            @endif
                        </div>
                        <div class="text-end">
                            <a href="{{ route('obat.index') }}" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn" style="background-color: #006400; color: white;">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection