@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="mb-3">🧾 Detail Pesanan</h4>

            <div class="mb-3">
                <p><i class="bi bi-calendar-event"></i> <strong>Tanggal:</strong> {{ $penjualan->created_at->format('d M Y') }}</p>
                <p><i class="bi bi-person-circle"></i> <strong>Nama Pemesan:</strong> {{ $penjualan->pelanggan->nama_pelanggan }}</p>

                {{-- <h5>Foto Resep:</h5>
                @if($penjualan->url_resep)
                            <img src="{{ $penjualan->url_resep }}" alt="Resep" width="80" height="80"
                                 style="object-fit: cover; border-radius: 6px; cursor: pointer;"
                                 onclick="showModal('{{ $penjualan->url_resep }}')">
                        @else
                            - 
                @endif --}}

                <p class="mt-3">
                    <i class="bi bi-cash-stack"></i>
                    <strong>Total Bayar (Sudah termasuk Ongkir + Biaya App):</strong>
                    <span class="text-success fw-bold">Rp{{ number_format($penjualan->total_bayar, 0, ',', '.') }}</span>
                </p>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Jenis Obat</th>
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
                                <td>{{ $item->obat->jenisObat->jenis ?? '-' }}</td>
                                <td>{{ $item->jumlah_beli }}</td>
                                <td>Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                <td class="text-success">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a style="background-color: orange;color:white;" href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


