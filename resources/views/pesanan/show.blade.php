//tambahin di bawah session error di atas
<form method="GET" action="{{ route('pesanan.index') }}" class="mb-4">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label for="status" class="sr-only">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">-- Semua Status --</option>
                                <option value="Menunggu Konfirmasi" {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="Menunggu Kurir" {{ request('status') == 'Menunggu Kurir' ? 'selected' : '' }}>Menunggu Kurir</option>
                                <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan Pembeli" {{ request('status') == 'Dibatalkan Pembeli' ? 'selected' : '' }}>Dibatalkan Pembeli</option>
                                <option value="Dibatalkan Penjual" {{ request('status') == 'Dibatalkan Penjual' ? 'selected' : '' }}>Dibatalkan Penjual</option>
                                <option value="Bermasalah" {{ request('status') == 'Bermasalah' ? 'selected' : '' }}>Bermasalah</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                        </div>
                    </div>
                </form>

//tambahin di bawah content

@php
    $cek = false;
    foreach ($orders as $o) {
        if ($o->status_order == 'Bermasalah') {
            $cek = true;
            break;
        }
    }
@endphp



@extends('fe.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detail Pesanan - Apotek Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front-end/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="goto-here">
    <!-- Header Section -->
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+62 123 4567 890</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">apotekonline@example.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">Pengiriman 1-3 Hari Kerja & Gratis Retur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('home.index') }}">Beranda</a></span> 
                        <span class="mr-2"><a href="{{ route('pesanan.index') }}">Pesanan Saya</a></span>
                        <span>Detail Pesanan</span>
                    </p>
                    <h1 class="mb-0 bread">Detail Pesanan #{{ $order->id }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 ftco-animate">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Informasi Pesanan</h5>
                            <span class="badge badge-light">
                                {{ \Carbon\Carbon::parse($order->tgl_penjualan)->format('d M Y H:i') }}
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6>Status Pesanan:</h6>
                                    <div class="status-badge 
                                        @if(in_array($order->status_order, ['Menunggu Konfirmasi', 'Menunggu Kurir'])) status-waiting
                                        @elseif($order->status_order == 'Diproses') status-processing
                                        @elseif(in_array($order->status_order, ['Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah'])) status-canceled
                                        @elseif($order->status_order == 'Selesai') status-completed
                                        @endif">
                                        {{ $order->status_order }}
                                    </div>
                                    @if($order->keterangan_status)
                                    <div class="mt-2">
                                        <small class="text-muted">{{ $order->keterangan_status }}</small>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-6 text-right">
                                    <h6>No. Pesanan:</h6>
                                    <p>#{{ $order->id }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="border p-3 mb-3">
                                        <h6>Informasi Pembayaran</h6>
                                        <hr>
                                        <p>
                                            <strong>Metode:</strong> {{ $order->metodeBayar->metode_pembayaran }}<br>
                                            @if($order->metodeBayar->no_rekening)
                                                <strong>No. Rekening:</strong> {{ $order->metodeBayar->no_rekening }}<br>
                                                <strong>Atas Nama:</strong> {{ $order->metodeBayar->atas_nama ?? 'Apotek Online' }}<br>
                                            @endif
                                            <strong>Status Pembayaran:</strong> 
                                            <span class="badge badge-{{ $order->status_pembayaran == 'Lunas' ? 'success' : 'warning' }}">
                                                {{ $order->status_pembayaran ?? 'Belum Dibayar' }}
                                            </span>
                                        </p>
                                        @if($order->status_order == 'Menunggu Konfirmasi' && $order->status_pembayaran != 'Lunas')
                                        <div class="alert alert-info mt-3">
                                            <h6>Instruksi Pembayaran:</h6>
                                            <p>Silahkan lakukan pembayaran ke rekening di atas dan upload bukti transfer melalui tombol di bawah.</p>
                                            <button class="btn btn-primary btn-sm">Upload Bukti Pembayaran</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border p-3 mb-3">
                                        <h6>Informasi Pengiriman</h6>
                                        <hr>
                                        <p>
                                            <strong>Kurir:</strong> {{ $order->jenisPengiriman->nama_ekspedisi }}<br>
                                            <strong>Jenis:</strong> {{ ucfirst($order->jenisPengiriman->jenis_kirim) }}<br>
                                            <strong>Ongkos Kirim:</strong> Rp {{ number_format($order->ongkos_kirim, 0, ',', '.') }}<br>
                                            <strong>Alamat:</strong> {{ $order->pelanggan->alamat1 }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if($order->url_resep)
                            <div class="border p-3 mb-3">
                                <h6>Resep Dokter</h6>
                                <hr>
                                <a href="{{ $order->url_resep }}" target="_blank" class="btn btn-info btn-sm">
                                    <i class="icon-download"></i> Lihat Resep
                                </a>
                            </div>
                            @endif

                            <div class="table-responsive mt-4">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->detailPenjualan as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-3">
                                                        <img src="{{ $item->obat->foto1 ? asset('storage/' . $item->obat->foto1) : asset('front-end/images/product-1.jpg') }}" 
                                                             alt="{{ $item->obat->nama_obat }}" 
                                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $item->obat->nama_obat }}</h6>
                                                        <small class="text-muted">{{ $item->obat->jenisObat->kategori }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                            <td>{{ $item->jumlah_beli }}</td>
                                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="border p-3">
                                        <h6>Catatan Pesanan</h6>
                                        <textarea class="form-control" rows="3" placeholder="Tulis catatan untuk penjual (opsional)"></textarea>
                                        <button class="btn btn-sm btn-secondary mt-2">Simpan Catatan</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="border p-3">
                                        <h6>Ringkasan Pembayaran</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Subtotal Produk</td>
                                                <td class="text-right">Rp {{ number_format($order->detailPenjualan->sum('subtotal'), 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Biaya Aplikasi</td>
                                                <td class="text-right">Rp {{ number_format($order->biaya_app, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ongkos Kirim</td>
                                                <td class="text-right">Rp {{ number_format($order->ongkos_kirim, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr class="table-active">
                                                <th>Total Pembayaran</th>
                                                <th class="text-right">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 text-right">
                                @if($order->status_order == 'Menunggu Konfirmasi')
                                <form action="{{ route('pesanan.batalkan', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-batal">
                                        <i class="icon-close"></i> Batalkan Pesanan
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">
                                    <i class="icon-arrow-left"></i> Kembali ke Daftar Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function(){
        // Fungsi untuk konfirmasi pembatalan pesanan
        $('.btn-batal').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: "Anda yakin ingin membatalkan pesanan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            })
        });
    });
    </script>

    <style>
    .status-badge {
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        display: inline-block;
    }
    
    .status-waiting {
        background-color: #ffc107;
        color: #000;
    }
    
    .status-processing {
        background-color: #17a2b8;
        color: #fff;
    }
    
    .status-canceled {
        background-color: #dc3545;
        color: #fff;
    }
    
    .status-completed {
        background-color: #28a745;
        color: #fff;
    }
    
    .card-header h5 {
        font-size: 1.2rem;
        font-weight: 600;
    }
    
    .table th {
        font-weight: 600;
    }
    
    .table-active {
        background-color: rgba(40, 167, 69, 0.1);
    }
    </style>
</body>
</html>
@endsection