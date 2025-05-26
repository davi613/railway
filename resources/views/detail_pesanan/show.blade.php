@extends('fe.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-3">🧾 Detail Pesanan <span class="text-primary"></span></h4>
            <div class="mb-3">
                <p><i class="bi bi-calendar-event"></i> <strong>Tanggal:</strong> {{ $penjualan->created_at->format('d M Y') }}</p>
                <p><i class="bi bi-person-circle"></i> <strong>Nama Pemesan:</strong> {{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p>
                <p><i class="bi bi-cash-stack"></i> <strong>Total Bayar (Sudah termasuk Ongkir+Biaya App):</strong> <span class="text-success fw-bold">Rp{{ number_format($penjualan->total_bayar, 0, ',', '.') }}</span></p>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail_penjualan as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->obat->nama_obat ?? '-' }}</td>
                            <td>{{ $item->jumlah_beli }}</td>
                            <td>Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td class="text-success">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
