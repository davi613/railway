@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')

<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container mt-5">
        <h2>Edit Penjualan</h2>
        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status_order">Status Order</label>
                <select style="color:black;" name="status_order" id="status_order" class="form-control" required>
                    {{-- <option value="Menunggu Konfirmasi" {{ $penjualan->status_order == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                    <option value="Diproses" {{ $penjualan->status_order == 'Diproses' ? 'selected' : '' }}>Diproses</option> --}}
                    <option value="Menunggu Kurir" {{ $penjualan->status_order == 'Menunggu Kurir' ? 'selected' : '' }}>Menunggu Kurir</option>
                    {{-- <option value="Dibatalkan Pembeli" {{ $penjualan->status_order == 'Dibatalkan Pembeli' ? 'selected' : '' }}>Dibatalkan Pembeli</option> --}}
                    <option value="Dibatalkan Penjual" {{ $penjualan->status_order == 'Dibatalkan Penjual' ? 'selected' : '' }}>Dibatalkan Penjual</option>
                    <option value="Bermasalah" {{ $penjualan->status_order == 'Bermasalah' ? 'selected' : '' }}>Bermasalah</option>
                    <option value="Selesai" {{ $penjualan->status_order == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan_status">Keterangan Status</label>
                <input type="text" name="keterangan_status" id="keterangan_status" class="form-control" value="{{ $penjualan->keterangan_status }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a style="background-color:orange;" href="{{ route('penjualan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>

@endsection
