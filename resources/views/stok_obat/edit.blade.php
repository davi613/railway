@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <h1 class="mb-4 text-center text-success">Edit Harga & Stok</h1>

    <form action="{{ route('stok_obat.update', $obat->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Obat</label>
            <input type="text" class="form-control" value="{{ $obat->nama_obat }}" readonly>
        </div>

        {{-- <div class="mb-3">
            <label class="form-label">Jenis Obat</label>
            <input type="text" class="form-control" value="{{ $obat->jenis->nama_jenis ?? '-' }}" readonly>
        </div> --}}

        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" name="harga_jual" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual', $obat->harga_jual) }}" required>
            @error('harga_jual')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok', $obat->stok) }}" required>
            @error('stok')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a style="background-color:orange;" href="{{ route('stok_obat.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

