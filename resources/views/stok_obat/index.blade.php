@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <h1 class="mb-4 text-center text-primary">Daftar Harga dan Stok Obat</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                {{-- <th>Jenis Obat</th> --}}
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obat as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_obat }}</td>
                {{-- <td>{{ $item->jenis->nama_jenis ?? '-' }}</td> --}}
                <td>Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $item->stok }}</td>
                <td>
                    <a href="{{ route('stok_obat.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

