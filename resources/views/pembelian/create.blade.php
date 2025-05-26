@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Tambahkan Pembelian</div>
                </div>

                <form action="{{ route('pembelian.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nonota" class="form-label">No Nota</label>
                        <input type="text" class="form-control" id="nonota" name="nonota" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tgl_pembelian" name="tgl_pembelian" required>
                    </div>
                    <div class="mb-3">
                        <label for="total_bayar" class="form-label">Total Bayar</label>
                        <input type="number" step="0.01" class="form-control" id="total_bayar" name="total_bayar" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_distributor" class="form-label">Distributor</label>
                        <select style="color:black;" class="form-select" id="id_distributor" name="id_distributor" required>
                            <option value="">Pilih Distributor</option>
                            @foreach ($distributors as $distributor)
                                <option value="{{ $distributor->id }}">{{ $distributor->nama_distributor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('pembelian.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn" style="background-color: #006400; color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
