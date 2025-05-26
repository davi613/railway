@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    .laporan-title {
        font-size: 26px;
        font-weight: bold;
        color: #34495e;
        margin-bottom: 25px;
    }

    .summary-box {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }

    .summary-card {
        flex: 1;
        background: linear-gradient(to right, #ecf0f1, #ffffff);
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
    }

    .summary-card:hover {
        transform: translateY(-5px);
    }

    .summary-card h4 {
        font-size: 18px;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .summary-card p {
        font-size: 16px;
        color: #2d3436;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        transition: 0.3s ease;
    }

    .card-header {
        background-color: #2e86de;
        color: white;
        font-weight: bold;
        font-size: 16px;
        padding: 12px 20px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
    }

    .table thead {
        background-color: #dff3ff;
        color: #2c3e50;
    }

    .table-hover tbody tr:hover {
        background-color: #f2f9ff;
        cursor: pointer;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12 fade-in">
            <div class="bg-white rounded h-100 p-4 shadow-sm">

                <!-- Heading -->
                <div class="laporan-title">
                    <i class="fas fa-chart-bar me-2 text-primary"></i> Laporan Pembelian
                    <a href="{{ url('/laporan/pembelian/download') }}" class="btn btn-success" target="_blank">
                        📄 Download Laporan Pembelian
                    </a>
                </div>

                <!-- Summary -->
                <div class="summary-box">
                    <div class="summary-card">
                        <h4><i class="fas fa-exchange-alt me-1 text-info"></i> Total Transaksi</h4>
                        <p>{{ number_format($totalTransaksi) }} Transaksi</p>
                    </div>
                    <div class="summary-card">
                        <h4><i class="fas fa-money-bill-wave me-1 text-success"></i> Total Nominal</h4>
                        <p>Rp {{ number_format($totalNominal, 2, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Table Card -->
                <div class="card">
                    <div class="card-header">
                        Rangkuman Detail Pembelian Obat
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th title="Nama Obat yang Dibeli">Nama Obat Yang Dibeli</th>
                                        <th>Jumlah Beli</th>
                                        <th>Subtotal</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($details as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $detail->obat->nama_obat ?? 'Nama Obat Tidak Ditemukan' }}</td>
                                            <td>{{ number_format($detail->jumlah_beli) }}</td>
                                            <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                                            <td>{{ $detail->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Tidak ada data pembelian ditemukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-4 d-flex justify-content-center">
                    {{ $details->links() }}
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JavaScript Fade-in Animations -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fadeInElements = document.querySelectorAll('.fade-in');
        fadeInElements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.2}s`;
        });
    });
</script>
@endsection
