@extends('fe.master')
@section('content')

<!-- Cek apakah ada pesanan dengan status bermasalah -->
@php
    $hasProblemOrder = $orders->contains(function($order) {
        return $order->status_order === 'Bermasalah';
    });
@endphp

<!-- Hero Section -->
<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs mb-1">
                    <span class="mr-2"><a href="{{ route('home.index') }}">Beranda</a></span>
                    <span>Pesanan Saya</span>
                </p>
                <h1 class="mb-3 bread">Pesanan Saya</h1>

                {{-- Tampilkan bagian "Pesanan Bermasalah" hanya jika ada --}}
                @if($hasProblemOrder)
                <div style="margin-top:100px;" class="alert alert-warning p-3 rounded" style="background-color: #fff3cd;">
                    <strong class="text-dark">Sepertinya ada pesanan kamu yang bermasalah</strong><br>
                    Silakan hubungi layanan pelanggan kami melalui:
                </div>
                @endif
            </div>

            {{-- Kontak Customer Service juga hanya tampil jika ada pesanan bermasalah --}}
            @if($hasProblemOrder)
            <div class="col-md-6 mt-4">
                <div class="bg-white p-4 rounded shadow-sm">
                    <h5 class="mb-3 font-weight-bold text-center">Hubungi Customer Service</h5>
                    <div class="contact-info-box mb-3 d-flex">
                        <span class="icon-map-marker contact-icon mr-3 mt-1 text-danger"></span>
                        <div>
                            <strong><a href="https://www.google.com/maps/place/Cibinong,+Bogor" target="_blank" class="text-dark">Alamat</a></strong>
                            <p class="mb-0">
                                <a href="https://www.google.com/maps/place/Cibinong,+Bogor" target="_blank" class="text-dark">
                                    Indonesia, Jawa Barat, Kab. Bogor, Cibinong
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="contact-info-box mb-3 d-flex">
                        <span class="icon-phone contact-icon mr-3 mt-1 text-success"></span>
                        <div>
                            <strong><a href="tel:+6281318614646" class="text-dark">Telepon</a></strong>
                            <p class="mb-0">
                                <a href="tel:+6281318614646" class="text-dark">+6281318614646</a>
                            </p>
                        </div>
                    </div>
                    <div class="contact-info-box d-flex">
                        <span class="icon-envelope contact-icon mr-3 mt-1 text-primary"></span>
                        <div>
                            <strong><a href="https://mail.google.com/mail/?view=cm&to=info@biopharm.com" target="_blank" class="text-dark">Email</a></strong>
                            <p class="mb-0">
                                <a href="https://mail.google.com/mail/?view=cm&to=info@biopharm.com" target="_blank" class="text-dark">info@biopharm.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- End Kontak -->
        </div>
    </div>
</div>

<!-- Main Content -->
<section style="margin-top: -200px" class="ftco-section">
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

                <form method="GET" action="{{ route('pesanan.index') }}" class="mb-4">
                    <div class="form-row align-items-center">
                      <h4 style="font-weight:bold">Filter Pesananmu: </h4>
                        <div class="col-auto">
                            <label for="status" class="sr-only">Status</label>
                            <select style="border-radius:10px; border-color:black;" name="status" id="status" class="form-control">
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
                        <div style="margin-top:10px;" class="col-auto">
                            <button style="width:200px;height:50px; font-weight: bold" type="submit" class="btn btn-primary">Terapkan Filter</button>
                        </div>
                    </div>
                </form>

                @if($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $index => $order)
                                    <tr>
                                        <td>{{ ($orders->currentPage() - 1) * $orders->perPage() + $index + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->tgl_penjualan)->format('d M Y') }}</td>
                                        <td>Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge 
                                                @if(in_array($order->status_order, ['Menunggu Konfirmasi', 'Menunggu Kurir'])) badge-warning
                                                @elseif($order->status_order == 'Diproses') badge-info
                                                @elseif(in_array($order->status_order, ['Dibatalkan Pembeli', 'Dibatalkan Penjual', 'Bermasalah'])) badge-danger
                                                @elseif($order->status_order == 'Selesai') badge-success
                                                @endif">
                                                {{ $order->status_order }}
                                            </span>
                                        </td>
                                        <td>{{ $order->keterangan_status ?? 'Belum Ada Keterangan' }}</td>
                                        <td>
                                            <a href="{{ route('detail_pesanan.show', $order->id) }}" class="btn btn-sm btn-info">Detail</a>
                                            @if($order->status_order == 'Menunggu Konfirmasi')
                                                <form id="form-batalkan-{{ $order->id }}" action="{{ route('pesanan.batalkan', $order->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('PUT')
                                                </form>
                                                <button type="button" class="btn btn-sm btn-danger swal-batalkan" data-id="{{ $order->id }}">
                                                    <i class="icon-close"></i> Batalkan
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Buttons -->
                    <div class="mt-4 text-center">
                        <button id="btn-prev" class="btn btn-custom" disabled>Previous</button>
                        <button id="btn-next" class="btn btn-custom">Next</button>
                    </div>
                @else
                    @if(request('status') != '')
                    <div class="alert alert-info text-center">
                        <h5>Status pesanan yang kamu pilih belum ada</h5>
                    </div>
                    @else
                    <div class="alert alert-info text-center">
                        <h5>Anda belum memiliki pesanan</h5>
                        <p>Silakan berbelanja terlebih dahulu</p>
                        <a href="{{ route('shop.index') }}" class="btn btn-hijau-theme">Belanja Sekarang</a>
                    </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // SweetAlert Batalkan Pesanan
        $('.swal-batalkan').click(function() {
            var orderId = $(this).data('id');
            Swal.fire({
                title: 'Batalkan Pesanan?',
                text: "Apakah kamu yakin ingin membatalkan pesanan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, batalkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-batalkan-' + orderId).submit();
                }
            });
        });

        // Pagination Buttons Logic
        const btnPrev = $('#btn-prev');
        const btnNext = $('#btn-next');
        const totalPages = {{ $orders->lastPage() }};
        let currentPage = {{ $orders->currentPage() }};

        updateButtons();

        btnPrev.click(function() {
            if(currentPage > 1){
                currentPage--;
                goToPage(currentPage);
            }
        });

        btnNext.click(function() {
            if(currentPage < totalPages){
                currentPage++;
                goToPage(currentPage);
            }
        });

        function goToPage(page) {
            const url = new URL(window.location.href);
            url.searchParams.set('page', page);
            window.location.href = url.toString();
        }

        function updateButtons() {
            btnPrev.prop('disabled', currentPage <= 1);
            btnNext.prop('disabled', currentPage >= totalPages);
        }
    });
</script>

<!-- Custom Styles -->
<style>
    .badge-green {
        background-color: #28a745;
        color: white;
    }
    .btn-hijau-theme {
        background-color: #28a745;
        color: #fff;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-hijau-theme:hover {
        background-color: #218838;
        color: #fff;
    }
    .btn-custom {
        background-color: #0069d9;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        font-weight: 600;
        border: none;
        margin: 0 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-custom:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }
    .btn-custom:hover:not(:disabled) {
        background-color: #004085;
    }
    .table th {
        font-weight: 600;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }
    .badge-info {
        background-color: #17a2b8;
        color: #fff;
    }
    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .badge-success {
        background-color: #28a745;
        color: #fff;
    }
</style>

@endsection
