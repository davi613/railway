@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.01);
    }

    .summary-box {
        display: flex;
        gap: 20px;
        margin: 30px 0;
        flex-wrap: wrap;
    }

    .summary-card {
        flex: 1;
        padding: 25px;
        background: linear-gradient(to right, #f1f2f6, #dff9fb);
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .summary-card:hover {
        transform: translateY(-5px);
    }

    .summary-card h4 {
        margin-bottom: 10px;
        color: #2c3e50;
        font-weight: 600;
    }

    .summary-card p {
        font-size: 16px;
        font-weight: 500;
        color: #2f3640;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
        font-size: 14px;
    }

    .table thead {
        background: linear-gradient(to right, #4facfe, #00f2fe);
        color: white;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f9ff;
        cursor: pointer;
    }

    .laporan-title {
        font-size: 24px;
        font-weight: bold;
        color: #2f3640;
        margin-bottom: 10px;
    }
</style>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm">

                <!-- Title -->
                <div class="laporan-title">
                    💰 Laporan Penjualan
                    <P>(hanya data penjualan dengan status "SELESAI" yang akan ditampilkan)</P>
                <a href="{{ url('/laporan/penjualan/download') }}" class="btn btn-success" target="_blank">
                    📄 Download Laporan Penjualan
                </a>


                </div>

                <!-- Summary Cards -->
                <div class="summary-box">
                    <div class="summary-card">
                        <h4>Total Penjualan</h4>
                        <p>{{ number_format($totalPenjualan) }} Transaksi</p>
                    </div>
                    <div class="summary-card">
                        <h4>Total Pendapatan</h4>
                        <p>Rp {{ number_format($totalBayar, 2, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Transaksi Penjualan</h5>
                    </div>
                    <div class="card-body">
                        @if($penjualan->isEmpty())
                            <div class="alert alert-info text-center">
                                <strong>Tidak Ada Data Penjualan</strong>.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Tanggal</th>
                                            <th>Total Bayar</th>
                                            <th>Status Order</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($penjualan as $index => $penjualan)
                                            <tr class="table-row">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($penjualan->tgl_penjualan)->format('d/m/Y H:i') }}</td>
                                                <td>Rp {{ number_format($penjualan->total_bayar, 2, ',', '.') }}</td>
                                                <td>
                                                    <span class="badge bg-success">{{ $penjualan->status_order }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- JS: Row highlight on click -->
<script>
    document.querySelectorAll('.table-row').forEach(row => {
        row.addEventListener('click', () => {
            document.querySelectorAll('.table-row').forEach(r => r.classList.remove('table-active'));
            row.classList.add('table-active');
        });
    });
</script>
@endsection
