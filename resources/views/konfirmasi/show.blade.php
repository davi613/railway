@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Detail Pesanan</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('konfirmasi.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('konfirmasi.index') }}">Konfirmasi</a>
            <span class="sep">/</span>
            <span>Detail</span>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<!-- Info Card -->
<div class="bph-card" style="margin-bottom:20px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-receipt-cutoff"></i> Informasi Pesanan
        </div>
    </div>
    <div class="bph-card-body">
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:20px;">
            <div style="background:#FFF7ED; border:1px solid #FEE2CC; border-radius:10px; padding:16px 20px;">
                <div style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--bph-muted); margin-bottom:6px;">
                    <i class="bi bi-calendar3 me-1"></i> Tanggal Order
                </div>
                <div style="font-size:1rem; font-weight:700; color:var(--bph-dark);">
                    {{ $penjualan->created_at->format('d M Y') }}
                </div>
            </div>
            <div style="background:#FFF7ED; border:1px solid #FEE2CC; border-radius:10px; padding:16px 20px;">
                <div style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:var(--bph-muted); margin-bottom:6px;">
                    <i class="bi bi-person-fill me-1"></i> Nama Pemesan
                </div>
                <div style="font-size:1rem; font-weight:700; color:var(--bph-dark);">
                    {{ $penjualan->pelanggan->nama_pelanggan }}
                </div>
            </div>
            <div style="background:linear-gradient(135deg,#FFF7ED,#FDBA74); border:1px solid #FB923C; border-radius:10px; padding:16px 20px;">
                <div style="font-size:0.78rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; color:#C2410C; margin-bottom:6px;">
                    <i class="bi bi-cash-stack me-1"></i> Total Bayar (Termasuk Ongkir + Biaya App)
                </div>
                <div style="font-size:1.2rem; font-weight:800; color:#9A3412;">
                    Rp{{ number_format($penjualan->total_bayar, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detail Items -->
<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-list-ul"></i> Detail Obat yang Dipesan
        </div>
    </div>
    <div class="bph-card-body-flush">
        <div class="bph-table-scroll">
            <table class="bph-table">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
                        <th style="text-align:center;">Jumlah</th>
                        <th style="text-align:right;">Harga</th>
                        <th style="text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail_penjualan as $item)
                        <tr>
                            <td style="text-align:center; font-weight:800;">{{ $loop->iteration }}</td>
                            <td style="font-weight:700;">{{ $item->obat->nama_obat ?? '-' }}</td>
                            <td><span class="bph-badge bph-badge-orange">{{ $item->obat->jenisObat->jenis ?? '-' }}</span></td>
                            <td style="text-align:center;">
                                <span class="bph-badge bph-badge-orange">{{ $item->jumlah_beli }}</span>
                            </td>
                            <td style="text-align:right; font-weight:600;">Rp{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                            <td style="text-align:right; font-weight:800; color:#16A34A;">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection