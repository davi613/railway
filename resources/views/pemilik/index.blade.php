@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container-fluid py-4">

    <h3 class="mb-4 text-primary fw-bold">Selamat Datang Di Dashboard Pemilik</h3>

    {{-- Statistik Kunci --}}
    <div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm rounded-4 border-0" style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: #fff;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-1">Total Pelanggan</h6>
                    <h2 class="fw-bold">{{ number_format($totalPelanggan) }}</h2>
                </div>
                <div style="font-size: 3rem;">
                    👥
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm rounded-4 border-0" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: #fff;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-1">Total Penjualan (Online)</h6>
                    <h2 class="fw-bold">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</h2>
                </div>
                <div style="font-size: 3rem;">
                    💰
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm rounded-4 border-0" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%); color: #fff;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <h6 class="text-uppercase fw-semibold mb-1">Total Pembelian</h6>
                    <h2 class="fw-bold">Rp {{ number_format($totalPembelian, 0, ',', '.') }}</h2>
                </div>
                <div style="font-size: 3rem;">
                    🛒
                </div>
            </div>
        </div>
    </div>
</div>


    {{-- Quick Actions --}}
    <div class="mb-4">
        <h5 class="mb-3 fw-semibold">Quick Actions</h5>
        <a  style="background-color: orange;" href="{{ url('/laporan/penjualan/download') }}" target="_blank" class="btn btn-sm btn-secondary me-2" style="background-color: #aab8c9; border:none;">📄 Unduh Laporan Penjualan</a>
        <a  style="background-color: navy;" href="{{ url('/laporan/pembelian/download') }}" target="_blank" class="btn btn-sm btn-secondary" style="background-color: #aab8c9; border:none;">📄 Unduh Laporan Pembelian</a>
        <a href="{{ route('laporan.jual.pdf') }}" target="_blank"
            class="btn btn-sm text-white"
            style="background: linear-gradient(45deg,rgb(27, 180, 30),rgb(16, 164, 110)); border: none;">
            🧾 Unduh Laporan Kasir 
        </a>

    </div>

</div>
@endsection
