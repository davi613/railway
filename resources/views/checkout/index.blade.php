@extends('fe.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - Apotek Online</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front-end/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="goto-here">

<!-- Global Loading Overlay -->
<div id="globalLoading" style="display:none;">
    <div class="global-loading-overlay">
        <div class="global-loading-content">
            <div class="global-loading-ring">
                <div></div><div></div><div></div><div></div>
            </div>
            <p id="loadingMessage" class="global-loading-text">Memproses...</p>
        </div>
    </div>
</div>

<!-- Hero Section -->
<div class="checkout-hero">
    <div class="checkout-hero-bg"></div>
    <div class="container">
        <div class="row no-gutters align-items-center justify-content-center">
            <div class="col-md-9 text-center">
                <p class="checkout-breadcrumb">
                    <a href="{{ route('home.index') }}">Beranda</a>
                    <span class="breadcrumb-sep"><i class="fa fa-chevron-right"></i></span>
                    <span>Checkout</span>
                </p>
                <h1 class="checkout-hero-title">Selesaikan Pesanan</h1>
                <p class="checkout-hero-sub">Lengkapi informasi dan lakukan pembayaran dengan aman</p>
            </div>
        </div>
    </div>
</div>

<!-- Step Indicator -->
<div class="checkout-steps-wrap">
    <div class="container">
        <div class="checkout-steps">
            <div class="step-item active">
                <div class="step-circle"><i class="fa fa-shopping-cart"></i></div>
                <span>Keranjang</span>
            </div>
            <div class="step-line active"></div>
            <div class="step-item active current">
                <div class="step-circle"><i class="fa fa-clipboard-list"></i></div>
                <span>Checkout</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item">
                <div class="step-circle"><i class="fa fa-credit-card"></i></div>
                <span>Pembayaran</span>
            </div>
            <div class="step-line"></div>
            <div class="step-item">
                <div class="step-circle"><i class="fa fa-check"></i></div>
                <span>Selesai</span>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Content -->
<section class="checkout-section">
    <div class="container">

        {{-- Tampilkan error validasi dari server --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Tampilkan pesan error dari session --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Tampilkan pesan info dari session --}}
        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
                {{ session('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="has_obat_keras" value="{{ $hasObatKeras ? 'true' : 'false' }}">

            <div class="row">
                <!-- LEFT COLUMN -->
                <div class="col-lg-8">

                    <!-- Informasi Pengiriman -->
                    <div class="co-card">
                        <div class="co-card-header">
                            <div class="co-card-icon"><i class="fa fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="co-card-title">Detail Pengiriman</h4>
                                <p class="co-card-subtitle">Pastikan alamat pengiriman sudah benar</p>
                            </div>
                        </div>
                        <div class="co-card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="co-field">
                                        <label class="co-label"><i class="fa fa-user"></i> Nama Lengkap</label>
                                        <input type="text" class="co-input" name="nama"
                                               value="{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="co-field">
                                        <label class="co-label"><i class="fa fa-phone"></i> No. Telepon</label>
                                        <input type="text" class="co-input" name="telepon"
                                               value="{{ Auth::guard('pelanggan')->user()->no_telp }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="co-field">
                                        <label class="co-label"><i class="fa fa-home"></i> Alamat Lengkap</label>
                                        <textarea class="co-input co-textarea" name="alamat" rows="3"
                                                  required>{{ Auth::guard('pelanggan')->user()->alamat1 }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="co-field">
                                        <label class="co-label">
                                            <i class="fa fa-file-medical"></i> Upload Resep Dokter
                                            @if($hasObatKeras)
                                                <span class="badge-required">Wajib</span>
                                            @else
                                                <span class="badge-optional">Opsional</span>
                                            @endif
                                        </label>
                                        <div class="co-file-upload" id="fileUploadArea">
                                            <input type="file"
                                                   class="co-file-input @error('file_resep') is-invalid @enderror"
                                                   id="file_resep" name="file_resep" accept="image/*">
                                            <div class="co-file-label" id="fileLabel">
                                                <i class="fa fa-cloud-upload-alt co-file-icon"></i>
                                                <span class="co-file-text">Klik untuk pilih file atau drag & drop</span>
                                                <span class="co-file-hint">JPG, JPEG, PNG — Maks. 2MB</span>
                                            </div>
                                        </div>
                                        @error('file_resep')
                                            <span class="co-error-text"><i class="fa fa-exclamation-circle"></i> {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Metode Pengiriman & Pembayaran -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="co-card">
                                <div class="co-card-header">
                                    <div class="co-card-icon"><i class="fa fa-truck"></i></div>
                                    <div>
                                        <h4 class="co-card-title">Metode Pengiriman</h4>
                                        <p class="co-card-subtitle">Pilih jasa pengiriman</p>
                                    </div>
                                </div>
                                <div class="co-card-body">
                                    @foreach($jenisPengiriman as $pengiriman)
                                    <label class="co-radio-card" for="pengiriman{{ $pengiriman->id }}">
                                        <input type="radio"
                                               id="pengiriman{{ $pengiriman->id }}"
                                               name="id_jenis_kirim"
                                               value="{{ $pengiriman->id }}"
                                               class="co-radio-input metode-pengiriman"
                                               data-ongkir="{{ $pengiriman->ongkos_kirim }}"
                                               required {{ $loop->first ? 'checked' : '' }}>
                                        <div class="co-radio-inner">
                                            <div class="co-logo-wrap">
                                                <img src="{{ asset('storage/' . $pengiriman->logo_ekspedisi) }}"
                                                     alt="{{ $pengiriman->nama_ekspedisi }}"
                                                     class="co-logo-img">
                                            </div>
                                            <div class="co-radio-info">
                                                <strong>{{ $pengiriman->nama_ekspedisi }}</strong>
                                                <small>{{ ucfirst($pengiriman->jenis_kirim) }}</small>
                                                <span class="co-price">Rp{{ number_format($pengiriman->ongkos_kirim, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="co-radio-check"><i class="fa fa-check"></i></div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="co-card">
                                <div class="co-card-header">
                                    <div class="co-card-icon"><i class="fa fa-credit-card"></i></div>
                                    <div>
                                        <h4 class="co-card-title">Metode Pembayaran</h4>
                                        <p class="co-card-subtitle">Virtual Account Bank</p>
                                    </div>
                                </div>
                                <div class="co-card-body">
                                    @foreach($metodeBayar as $bayar)
                                    <label class="co-radio-card" for="pembayaran{{ $bayar->id }}">
                                        <input type="radio"
                                               id="pembayaran{{ $bayar->id }}"
                                               name="id_metode_bayar"
                                               value="{{ $bayar->id }}"
                                               class="co-radio-input payment-radio"
                                               required {{ $loop->first ? 'checked' : '' }}>
                                        <div class="co-radio-inner">
                                            <div class="co-logo-wrap">
                                                <img src="{{ asset('storage/' . $bayar->url_logo) }}"
                                                     alt="{{ $bayar->metode_pembayaran }}"
                                                     class="co-logo-img">
                                            </div>
                                            <div class="co-radio-info">
                                                <strong>{{ $bayar->metode_pembayaran }}</strong>
                                                <small>{{ $bayar->tempat_bayar }}</small>
                                            </div>
                                            <div class="co-radio-check"><i class="fa fa-check"></i></div>
                                        </div>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Pesanan -->
                    <div class="co-card">
                        <div class="co-card-header">
                            <div class="co-card-icon"><i class="fa fa-receipt"></i></div>
                            <div>
                                <h4 class="co-card-title">Ringkasan Pesanan</h4>
                                <p class="co-card-subtitle">Detail produk yang akan dibeli</p>
                            </div>
                        </div>
                        <div class="co-card-body p-0">
                            <div class="co-order-table-wrap">
                                <table class="co-order-table">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                        <tr>
                                            <td>
                                                <div class="co-product-name">
                                                    <i class="fa fa-capsules co-product-icon"></i>
                                                    {{ $item->obat->nama_obat }}
                                                </div>
                                            </td>
                                            <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td><span class="co-qty-badge">{{ $item->jumlah_order }}</span></td>
                                            <td class="co-subtotal">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="co-tfoot-row">
                                            <td colspan="3">Subtotal Produk</td>
                                            <td class="subtotal-display co-subtotal">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="co-tfoot-row">
                                            <td colspan="3">Biaya Aplikasi</td>
                                            <td class="biaya-app-display co-subtotal">Rp{{ number_format($biayaApp, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="co-tfoot-row">
                                            <td colspan="3">Ongkos Kirim</td>
                                            <td class="ongkir-display co-subtotal">Rp{{ number_format($jenisPengiriman->first()->ongkos_kirim ?? 0, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="co-tfoot-total">
                                            <td colspan="3"><strong>Total Pembayaran</strong></td>
                                            <td class="total-display"><strong>Rp{{ number_format($total + ($jenisPengiriman->first()->ongkos_kirim ?? 0), 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT COLUMN -->
                <div class="col-lg-4">
                    <div class="co-sticky-summary">

                        <!-- Payment Summary Card -->
                        <div class="co-card co-summary-card">
                            <div class="co-summary-header">
                                <i class="fa fa-lock"></i>
                                <span>Ringkasan Pembayaran</span>
                            </div>
                            <div class="co-summary-body">
                                <div class="co-summary-row">
                                    <span>Subtotal Produk</span>
                                    <span class="subtotal-display">Rp{{ number_format($subtotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="co-summary-row">
                                    <span>Biaya Aplikasi</span>
                                    <span class="biaya-app-display">Rp{{ number_format($biayaApp, 0, ',', '.') }}</span>
                                </div>
                                <div class="co-summary-row">
                                    <span>Ongkos Kirim</span>
                                    <span class="ongkir-display">Rp{{ number_format($jenisPengiriman->first()->ongkos_kirim ?? 0, 0, ',', '.') }}</span>
                                </div>
                                <div class="co-summary-divider"></div>
                                <div class="co-summary-total-row">
                                    <span>Total</span>
                                    <span class="total-display">Rp{{ number_format($total + ($jenisPengiriman->first()->ongkos_kirim ?? 0), 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Security & Terms Card -->
                        <div class="co-card co-security-card">
                            <div class="co-security-list">
                                <div class="co-security-item">
                                    <i class="fa fa-shield-alt"></i>
                                    <span>Pembayaran aman via Midtrans</span>
                                </div>
                                <div class="co-security-item">
                                    <i class="fa fa-lock"></i>
                                    <span>Data terenkripsi SSL</span>
                                </div>
                                <div class="co-security-item">
                                    <i class="fa fa-undo"></i>
                                    <span>Pesanan terkonfirmasi otomatis</span>
                                </div>
                            </div>

                            {{-- Notifikasi wajib centang terms --}}
                            <div class="co-terms-alert" id="termsAlert" style="display:none;">
                                <i class="fa fa-exclamation-triangle"></i>
                                <span>Anda harus menyetujui syarat dan ketentuan terlebih dahulu sebelum melanjutkan pembayaran.</span>
                            </div>

                            <div class="co-terms-check">
                                <label class="co-checkbox-label" for="agree_terms">
                                    <input type="checkbox" class="co-checkbox-input" id="agree_terms" name="agree_terms">
                                    <span class="co-checkbox-custom"></span>
                                    <span class="co-checkbox-text">
                                        Saya menyetujui
                                        <a href="#" data-toggle="modal" data-target="#termsModal" class="co-terms-link">syarat dan ketentuan</a>
                                        yang berlaku
                                    </span>
                                </label>
                            </div>

                            <button type="submit" class="co-pay-btn" id="submitBtn">
                                <span class="co-pay-btn-inner">
                                    <i class="fa fa-lock"></i>
                                    <span>Bayar Sekarang</span>
                                    <i class="fa fa-arrow-right co-btn-arrow"></i>
                                </span>
                            </button>

                            <a href="{{ route('cart.index') }}" class="co-back-btn">
                                <i class="fa fa-shopping-cart"></i> Kembali ke Keranjang
                            </a>
                        </div>

                        <!-- Midtrans Logo -->
                        <div class="co-midtrans-badge">
                            <span>Powered by</span>
                            <strong>Midtrans</strong>
                            <i class="fa fa-check-circle"></i>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content co-modal">
            <div class="modal-header co-modal-header">
                <h5 class="modal-title" id="termsModalLabel"><i class="fa fa-file-contract"></i> Syarat dan Ketentuan</h5>
                <button type="button" class="close co-modal-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body co-modal-body">
                <div class="co-terms-section">
                    <div class="co-terms-item"><i class="fa fa-pills"></i><div><strong>Layanan</strong><p>Aplikasi menyediakan pembelian obat bebas dan obat resep. Obat keras hanya bisa dibeli dengan resep dokter.</p></div></div>
                    <div class="co-terms-item"><i class="fa fa-user-shield"></i><div><strong>Data Pengguna</strong><p>Data pribadi digunakan hanya untuk keperluan transaksi dan dijaga kerahasiaannya.</p></div></div>
                    <div class="co-terms-item"><i class="fa fa-credit-card"></i><div><strong>Pembayaran</strong><p>Transaksi dilakukan melalui metode pembayaran yang tersedia di aplikasi dan tidak bisa diubah setelah diproses.</p></div></div>
                    <div class="co-terms-item"><i class="fa fa-truck"></i><div><strong>Pengiriman</strong><p>Obat dikirim ke alamat pengguna sesuai wilayah layanan. Pastikan data pengiriman benar.</p></div></div>
                    <div class="co-terms-item"><i class="fa fa-undo"></i><div><strong>Pengembalian</strong><p>Obat tidak dapat dikembalikan, kecuali salah kirim, rusak, atau kedaluwarsa.</p></div></div>
                    <div class="co-terms-item"><i class="fa fa-balance-scale"></i><div><strong>Tanggung Jawab</strong><p>Penggunaan obat menjadi tanggung jawab pengguna. Aplikasi hanya sebagai perantara antara apotek dan pembeli.</p></div></div>
                    <div class="co-terms-item"><i class="fa fa-sync"></i><div><strong>Perubahan Ketentuan</strong><p>Ketentuan dapat berubah sewaktu-waktu. Pengguna dianggap setuju setelah menggunakan aplikasi.</p></div></div>
                </div>
            </div>
            <div class="modal-footer co-modal-footer">
                <button type="button" class="co-modal-btn" data-dismiss="modal">Saya Mengerti</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
$(document).ready(function(){

    // ========================
    // FILE UPLOAD PREVIEW
    // ========================
    $('#file_resep').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        if (fileName) {
            $('#fileLabel').html('<i class="fa fa-file-image co-file-icon" style="color:#ffa500;"></i><span class="co-file-text">' + fileName + '</span><span class="co-file-hint">File siap diupload</span>');
            $('#fileUploadArea').addClass('co-file-selected');
        }
    });

    // Drag & drop styling
    $('#fileUploadArea').on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('co-file-drag');
    }).on('dragleave drop', function() {
        $(this).removeClass('co-file-drag');
    });

    // ========================
    // UPDATE TOTAL
    // ========================
    function updateTotal() {
        let subtotal  = parseFloat("{{ $subtotal }}");
        let biayaApp  = parseFloat("{{ $biayaApp }}");
        let ongkir    = parseFloat($('input[name="id_jenis_kirim"]:checked').data('ongkir')) || 0;
        let total     = subtotal + biayaApp + ongkir;

        let fmt = function(n){ return 'Rp' + n.toLocaleString('id-ID'); };

        $('.subtotal-display').text(fmt(subtotal));
        $('.biaya-app-display').text(fmt(biayaApp));
        $('.ongkir-display').text(fmt(ongkir));
        $('.total-display').text(fmt(total));
    }

    $('input[name="id_jenis_kirim"]').on('change', updateTotal);
    updateTotal();

    // ========================
    // RADIO CARD ACTIVE STATE
    // ========================
    $('input.co-radio-input').on('change', function(){
        $(this).closest('.co-card-body').find('.co-radio-card').removeClass('co-radio-active');
        $(this).closest('.co-radio-card').addClass('co-radio-active');
    });
    // Set initial active
    $('input.co-radio-input:checked').each(function(){
        $(this).closest('.co-radio-card').addClass('co-radio-active');
    });

    // ========================
    // CHECKBOX TERMS — sembunyikan alert jika sudah dicentang
    // ========================
    $('#agree_terms').on('change', function() {
        if ($(this).is(':checked')) {
            $('#termsAlert').slideUp(200);
            $('.co-terms-check').removeClass('co-terms-error');
        }
    });

    // ========================
    // FORM SUBMIT — validasi terms lalu submit ke server untuk dapatkan snap_token
    // ========================
    $('#checkoutForm').on('submit', function(e) {
        // Cek checkbox terms
        if (!$('#agree_terms').is(':checked')) {
            e.preventDefault();

            // Tampilkan alert inline di bawah security list
            $('#termsAlert').slideDown(200);
            $('.co-terms-check').addClass('co-terms-error');

            // Scroll ke alert terms agar user bisa lihat
            $('html, body').animate({
                scrollTop: $('#termsAlert').offset().top - 120
            }, 400);

            // Juga tampilkan SweetAlert agar lebih jelas
            Swal.fire({
                icon: 'warning',
                title: 'Persetujuan Diperlukan',
                text: 'Anda harus mencentang dan menyetujui syarat dan ketentuan terlebih dahulu sebelum melanjutkan pembayaran.',
                confirmButtonColor: '#ffa500',
                confirmButtonText: 'Mengerti, Saya Akan Centang'
            });
            return false;
        }

        // Tampilkan loading
        $('#submitBtn').prop('disabled', true).html(
            '<span class="co-pay-btn-inner"><i class="fa fa-spinner fa-spin"></i><span>Memproses...</span></span>'
        );
        showGlobalLoading('Memproses pesanan Anda...');
    });

    // ========================
    // GLOBAL LOADING
    // ========================
    function showGlobalLoading(msg) {
        $('#loadingMessage').text(msg || 'Memproses...');
        $('#globalLoading').fadeIn(200);
        $('body').css('overflow', 'hidden');
    }

    function hideGlobalLoading() {
        $('#globalLoading').fadeOut(200);
        $('body').css('overflow', '');
    }

    // ========================
    // SNAP POPUP — otomatis muncul jika ada snap_token dari session
    // snap_token dikirim dari controller via session flash setelah form submit
    // ========================
    @if(session('snap_token'))
    var snapToken = "{{ session('snap_token') }}";

    // Sembunyikan loading dulu karena snap akan muncul
    hideGlobalLoading();

    // Panggil Snap popup
    snap.pay(snapToken, {
        onSuccess: function(result) {
            // Pembayaran berhasil — kirim data ke server untuk buat penjualan via AJAX
            showGlobalLoading('Menyimpan pesanan Anda...');

            $.ajax({
                url: "{{ route('checkout.createOrder') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_id: result.order_id,
                    transaction_status: result.transaction_status,
                    fraud_status: result.fraud_status || ''
                },
                success: function(response) {
                    hideGlobalLoading();
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Berhasil!',
                            text: response.message || 'Pesanan Anda sedang diproses.',
                            confirmButtonColor: '#ffa500',
                            confirmButtonText: 'Lihat Pesanan',
                            allowOutsideClick: false
                        }).then(function() {
                            window.location.href = response.redirect;
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.message || 'Terjadi kesalahan, hubungi admin.',
                            confirmButtonColor: '#ffa500',
                            confirmButtonText: 'Lihat Pesanan'
                        }).then(function() {
                            window.location.href = response.redirect;
                        });
                    }
                },
                error: function(xhr) {
                    hideGlobalLoading();
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Pembayaran berhasil tetapi terjadi kesalahan sistem. Silakan hubungi admin.',
                        confirmButtonColor: '#ffa500',
                        confirmButtonText: 'Lihat Pesanan'
                    }).then(function() {
                        window.location.href = "{{ route('pesanan.index') }}";
                    });
                }
            });
        },
        onPending: function(result) {
            // Pembayaran pending — simpan juga ke DB agar bisa ditrack
            showGlobalLoading('Menyimpan pesanan Anda...');

            $.ajax({
                url: "{{ route('checkout.createOrder') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    order_id: result.order_id,
                    transaction_status: result.transaction_status || 'pending',
                    fraud_status: result.fraud_status || ''
                },
                success: function(response) {
                    hideGlobalLoading();
                    Swal.fire({
                        icon: 'info',
                        title: 'Pembayaran Pending',
                        text: 'Pesanan Anda telah disimpan. Silakan selesaikan pembayaran sesuai instruksi.',
                        confirmButtonColor: '#ffa500',
                        confirmButtonText: 'Lihat Pesanan',
                        allowOutsideClick: false
                    }).then(function() {
                        window.location.href = response.redirect || "{{ route('pesanan.index') }}";
                    });
                },
                error: function() {
                    hideGlobalLoading();
                    window.location.href = "{{ route('pesanan.index') }}";
                }
            });
        },
        onError: function(result) {
            hideGlobalLoading();
            Swal.fire({
                icon: 'error',
                title: 'Pembayaran Gagal',
                text: 'Terjadi kesalahan saat melakukan pembayaran. Silakan coba lagi.',
                confirmButtonColor: '#ffa500',
                confirmButtonText: 'Coba Lagi'
            });
            // Aktifkan kembali tombol bayar
            $('#submitBtn').prop('disabled', false).html(
                '<span class="co-pay-btn-inner"><i class="fa fa-lock"></i><span>Bayar Sekarang</span><i class="fa fa-arrow-right co-btn-arrow"></i></span>'
            );
        },
        onClose: function() {
            hideGlobalLoading();
            // User menutup Snap tanpa bayar — biarkan tetap di halaman checkout
            $('#submitBtn').prop('disabled', false).html(
                '<span class="co-pay-btn-inner"><i class="fa fa-lock"></i><span>Bayar Sekarang</span><i class="fa fa-arrow-right co-btn-arrow"></i></span>'
            );
            Swal.fire({
                icon: 'info',
                title: 'Pembayaran Dibatalkan',
                text: 'Anda menutup halaman pembayaran. Keranjang Anda masih tersimpan.',
                confirmButtonColor: '#ffa500',
                confirmButtonText: 'Mengerti'
            });
        }
    });
    @endif

});
</script>

<style>
/* ============================================================
   CHECKOUT PAGE — MODERN ORANGE THEME
   Font: Plus Jakarta Sans
   ============================================================ */

*, *::before, *::after { box-sizing: border-box; }

body, .checkout-section { font-family: 'Plus Jakarta Sans', sans-serif; }

/* ---------------------- GLOBAL LOADING ---------------------- */
.global-loading-overlay {
    position: fixed; inset: 0;
    background: rgba(255,255,255,0.97);
    z-index: 99999;
    display: flex; align-items: center; justify-content: center;
}
.global-loading-content { text-align: center; }
.global-loading-ring {
    display: inline-block; position: relative; width: 64px; height: 64px;
}
.global-loading-ring div {
    box-sizing: border-box; display: block; position: absolute;
    width: 48px; height: 48px; margin: 8px;
    border: 4px solid #ffa500; border-radius: 50%;
    animation: ring-spin 1.2s cubic-bezier(0.5,0,0.5,1) infinite;
    border-color: #ffa500 transparent transparent transparent;
}
.global-loading-ring div:nth-child(1){animation-delay:-0.45s}
.global-loading-ring div:nth-child(2){animation-delay:-0.3s}
.global-loading-ring div:nth-child(3){animation-delay:-0.15s}
@keyframes ring-spin { 0%{transform:rotate(0)} 100%{transform:rotate(360deg)} }
.global-loading-text {
    margin-top: 18px; font-size: 1rem; font-weight: 600;
    color: #444; letter-spacing: 0.3px;
}

/* ---------------------- HERO ---------------------- */
.checkout-hero {
    position: relative;
    background: linear-gradient(135deg, #ff8c00 0%, #ffa500 40%, #ffb733 100%);
    padding: 80px 0 50px;
    overflow: hidden;
}
.checkout-hero-bg {
    position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}
.checkout-breadcrumb {
    color: rgba(255,255,255,0.8);
    font-size: 0.85rem;
    margin-bottom: 12px;
    position: relative;
}
.checkout-breadcrumb a { color: rgba(255,255,255,0.9); text-decoration: none; }
.checkout-breadcrumb a:hover { color: #fff; }
.breadcrumb-sep { margin: 0 8px; font-size: 0.7rem; opacity: 0.7; }
.checkout-hero-title {
    font-size: 2.6rem; font-weight: 800;
    color: #fff; margin-bottom: 10px;
    text-shadow: 0 2px 12px rgba(0,0,0,0.15);
    position: relative;
}
.checkout-hero-sub {
    color: rgba(255,255,255,0.85); font-size: 1rem;
    position: relative;
}

/* ---------------------- STEPS ---------------------- */
.checkout-steps-wrap {
    background: #fff;
    border-bottom: 1px solid #f0f0f0;
    padding: 18px 0;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
}
.checkout-steps {
    display: flex; align-items: center; justify-content: center; gap: 0;
}
.step-item {
    display: flex; flex-direction: column; align-items: center; gap: 6px;
    opacity: 0.4; transition: opacity 0.3s;
}
.step-item.active { opacity: 1; }
.step-item.current .step-circle {
    background: #ffa500 !important; color: #fff !important;
    box-shadow: 0 0 0 4px rgba(255,165,0,0.2);
    transform: scale(1.1);
}
.step-circle {
    width: 40px; height: 40px; border-radius: 50%;
    background: #f5f5f5; color: #aaa;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; font-weight: 700;
    transition: all 0.3s;
}
.step-item.active:not(.current) .step-circle {
    background: #fff3e0; color: #ffa500;
}
.step-item span {
    font-size: 0.72rem; font-weight: 600; color: #888; white-space: nowrap;
}
.step-item.active span { color: #ffa500; }
.step-line {
    flex: 1; height: 2px; background: #eee;
    max-width: 60px; min-width: 20px;
    transition: background 0.3s;
}
.step-line.active { background: #ffa500; }

/* ---------------------- SECTION ---------------------- */
.checkout-section { background: #f8f8f8; padding: 40px 0 60px; }

/* ---------------------- CO-CARD ---------------------- */
.co-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.06);
    margin-bottom: 24px;
    overflow: hidden;
    transition: box-shadow 0.3s;
}
.co-card:hover { box-shadow: 0 6px 28px rgba(0,0,0,0.1); }

.co-card-header {
    display: flex; align-items: center; gap: 14px;
    padding: 20px 24px;
    border-bottom: 1px solid #ffecd0;
    background: linear-gradient(90deg, #fff9f0, #fff);
}
.co-card-icon {
    width: 44px; height: 44px;
    background: linear-gradient(135deg, #ffa500, #ff8c00);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 1rem;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(255,165,0,0.3);
}
.co-card-title {
    font-size: 1rem; font-weight: 700; color: #222; margin: 0;
}
.co-card-subtitle {
    font-size: 0.78rem; color: #999; margin: 2px 0 0;
}
.co-card-body { padding: 24px; }
.co-card-body.p-0 { padding: 0; }

/* ---------------------- FORM FIELDS ---------------------- */
.co-field { margin-bottom: 18px; }
.co-label {
    display: block; font-size: 0.82rem;
    font-weight: 700; color: #444;
    margin-bottom: 8px; letter-spacing: 0.3px;
}
.co-label i { color: #ffa500; margin-right: 6px; }
.co-input {
    width: 100%; padding: 12px 16px;
    border: 2px solid #f0f0f0;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 0.9rem; color: #333;
    background: #fafafa;
    transition: all 0.25s;
    outline: none;
}
.co-input:focus {
    border-color: #ffa500;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(255,165,0,0.12);
}
.co-textarea { resize: vertical; min-height: 90px; }

/* ---------------------- FILE UPLOAD ---------------------- */
.co-file-upload { position: relative; cursor: pointer; }
.co-file-input {
    position: absolute; inset: 0; width: 100%; height: 100%;
    opacity: 0; cursor: pointer; z-index: 2;
}
.co-file-label {
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    gap: 6px;
    padding: 28px 20px;
    border: 2px dashed #ffd080;
    border-radius: 12px;
    background: #fffbf0;
    text-align: center;
    transition: all 0.25s;
}
.co-file-upload:hover .co-file-label,
.co-file-upload.co-file-drag .co-file-label {
    border-color: #ffa500; background: #fff3d0;
}
.co-file-upload.co-file-selected .co-file-label { border-color: #ffa500; }
.co-file-icon { font-size: 2rem; color: #ffc966; display: block; }
.co-file-text { font-size: 0.85rem; font-weight: 600; color: #555; }
.co-file-hint { font-size: 0.75rem; color: #aaa; }
.co-error-text { font-size: 0.8rem; color: #dc3545; margin-top: 4px; display: block; }
.badge-required {
    background: #dc3545; color: #fff;
    font-size: 0.65rem; padding: 2px 7px;
    border-radius: 20px; margin-left: 6px; font-weight: 600;
}
.badge-optional {
    background: #ffa500; color: #fff;
    font-size: 0.65rem; padding: 2px 7px;
    border-radius: 20px; margin-left: 6px; font-weight: 600;
}

/* ---------------------- RADIO CARD ---------------------- */
.co-radio-card { display: block; cursor: pointer; margin-bottom: 10px; }
.co-radio-input { display: none; }
.co-radio-inner {
    display: flex; align-items: center; gap: 12px;
    padding: 14px 16px;
    border: 2px solid #f0f0f0;
    border-radius: 12px;
    background: #fafafa;
    transition: all 0.25s;
    position: relative;
}
.co-radio-card:hover .co-radio-inner {
    border-color: #ffcc66; background: #fffbf0;
}
.co-radio-card.co-radio-active .co-radio-inner {
    border-color: #ffa500; background: #fff9ee;
    box-shadow: 0 2px 12px rgba(255,165,0,0.15);
}
.co-logo-wrap {
    width: 48px; height: 48px; flex-shrink: 0;
    background: #fff; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    padding: 4px;
}
.co-logo-img { max-width: 100%; max-height: 40px; object-fit: contain; }
.co-radio-info {
    flex: 1; display: flex; flex-direction: column; gap: 2px;
}
.co-radio-info strong { font-size: 0.88rem; color: #222; font-weight: 700; }
.co-radio-info small { font-size: 0.75rem; color: #999; }
.co-price { font-size: 0.85rem; font-weight: 700; color: #ffa500; }
.co-radio-check {
    width: 22px; height: 22px; border-radius: 50%;
    border: 2px solid #ddd;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; color: transparent;
    transition: all 0.2s; flex-shrink: 0;
}
.co-radio-card.co-radio-active .co-radio-check {
    background: #ffa500; border-color: #ffa500; color: #fff;
}

/* ---------------------- ORDER TABLE ---------------------- */
.co-order-table-wrap { overflow-x: auto; }
.co-order-table {
    width: 100%; border-collapse: collapse;
    font-size: 0.88rem;
}
.co-order-table thead tr {
    background: linear-gradient(90deg, #ffa500, #ff8c00);
}
.co-order-table thead th {
    padding: 14px 18px; color: #fff;
    font-weight: 700; font-size: 0.82rem;
    text-transform: uppercase; letter-spacing: 0.5px;
}
.co-order-table tbody tr {
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.2s;
}
.co-order-table tbody tr:hover { background: #fffbf0; }
.co-order-table tbody td { padding: 14px 18px; color: #444; }
.co-product-name { display: flex; align-items: center; gap: 8px; font-weight: 600; }
.co-product-icon { color: #ffa500; font-size: 0.9rem; }
.co-qty-badge {
    background: #fff3e0; color: #ffa500;
    padding: 3px 10px; border-radius: 20px;
    font-weight: 700; font-size: 0.82rem;
}
.co-subtotal { font-weight: 700; color: #333; }
.co-tfoot-row td {
    padding: 12px 18px;
    border-top: 1px solid #f0f0f0;
    color: #666; font-size: 0.85rem;
}
.co-tfoot-row .co-subtotal { color: #444; }
.co-tfoot-total {
    background: linear-gradient(90deg, #fff3e0, #fff9f0);
    border-top: 2px solid #ffa500 !important;
}
.co-tfoot-total td {
    padding: 16px 18px; font-size: 1rem;
    color: #ff8c00 !important;
}

/* ---------------------- STICKY SUMMARY ---------------------- */
.co-sticky-summary { position: sticky; top: 24px; }

.co-summary-card { overflow: visible; }
.co-summary-header {
    background: linear-gradient(135deg, #ff8c00, #ffa500);
    color: #fff; padding: 18px 22px;
    display: flex; align-items: center; gap: 10px;
    font-size: 0.95rem; font-weight: 700;
    border-radius: 16px 16px 0 0;
}
.co-summary-header i { font-size: 1rem; }
.co-summary-body { padding: 20px 22px; }
.co-summary-row {
    display: flex; justify-content: space-between;
    align-items: center; padding: 8px 0;
    font-size: 0.88rem; color: #555;
}
.co-summary-row span:last-child { font-weight: 600; color: #333; }
.co-summary-divider { height: 1px; background: #f0f0f0; margin: 10px 0; }
.co-summary-total-row {
    display: flex; justify-content: space-between;
    align-items: center; padding-top: 6px;
}
.co-summary-total-row span:first-child { font-size: 0.95rem; font-weight: 700; color: #222; }
.co-summary-total-row span:last-child {
    font-size: 1.25rem; font-weight: 800; color: #ffa500;
}

/* ---------------------- SECURITY CARD ---------------------- */
.co-security-card { padding: 0; }
.co-security-list {
    padding: 18px 22px 14px;
    border-bottom: 1px solid #f5f5f5;
}
.co-security-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.82rem; color: #555; padding: 6px 0;
}
.co-security-item i { color: #ffa500; font-size: 0.85rem; flex-shrink: 0; }

/* ---------------------- TERMS ALERT (notifikasi wajib centang) ---------------------- */
.co-terms-alert {
    margin: 0 22px;
    padding: 12px 14px;
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 10px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 0.82rem;
    color: #856404;
    font-weight: 600;
    margin-top: 14px;
}
.co-terms-alert i {
    color: #e67e00;
    font-size: 1rem;
    flex-shrink: 0;
    margin-top: 1px;
}

/* ---------------------- TERMS CHECKBOX ---------------------- */
.co-terms-check { padding: 16px 22px; border-bottom: 1px solid #f5f5f5; }
.co-terms-check.co-terms-error .co-checkbox-custom {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 3px rgba(220,53,69,0.15);
}
.co-checkbox-label {
    display: flex; align-items: flex-start; gap: 12px;
    cursor: pointer; font-size: 0.82rem; color: #555; line-height: 1.5;
}
.co-checkbox-input { display: none; }
.co-checkbox-custom {
    width: 20px; height: 20px; flex-shrink: 0;
    border: 2px solid #ddd; border-radius: 6px;
    background: #fafafa;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; margin-top: 1px;
}
.co-checkbox-input:checked + .co-checkbox-custom {
    background: #ffa500; border-color: #ffa500;
}
.co-checkbox-input:checked + .co-checkbox-custom::after {
    content: '✓'; color: #fff; font-size: 0.75rem; font-weight: 700;
}
.co-terms-link { color: #ffa500; font-weight: 700; text-decoration: none; }
.co-terms-link:hover { color: #e07800; text-decoration: underline; }

/* ---------------------- BUTTONS ---------------------- */
.co-pay-btn {
    display: block; width: calc(100% - 44px); margin: 18px 22px 10px;
    background: linear-gradient(135deg, #ff8c00, #ffa500);
    color: #fff; border: none;
    padding: 16px 20px;
    border-radius: 12px; font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 1rem; font-weight: 800; cursor: pointer;
    box-shadow: 0 6px 20px rgba(255,140,0,0.35);
    transition: all 0.3s;
}
.co-pay-btn:hover {
    background: linear-gradient(135deg, #e07800, #ffa500);
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(255,140,0,0.4);
    color: #fff;
}
.co-pay-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
.co-pay-btn-inner {
    display: flex; align-items: center; justify-content: center; gap: 10px;
}
.co-btn-arrow { margin-left: auto; font-size: 0.85rem; opacity: 0.8; }

.co-back-btn {
    display: block; text-align: center;
    margin: 0 22px 18px;
    padding: 12px 20px;
    border: 2px solid #ffa500;
    border-radius: 12px;
    color: #ffa500; font-weight: 700; font-size: 0.88rem;
    text-decoration: none;
    transition: all 0.25s;
}
.co-back-btn:hover {
    background: #ffa500; color: #fff;
    transform: translateY(-1px);
}

/* ---------------------- MIDTRANS BADGE ---------------------- */
.co-midtrans-badge {
    text-align: center; padding: 12px;
    font-size: 0.78rem; color: #999;
    display: flex; align-items: center; justify-content: center; gap: 6px;
}
.co-midtrans-badge strong { color: #555; }
.co-midtrans-badge i { color: #28a745; }

/* ---------------------- MODAL ---------------------- */
.co-modal { border-radius: 16px; overflow: hidden; border: none; }
.co-modal-header {
    background: linear-gradient(135deg, #ff8c00, #ffa500);
    color: #fff; padding: 18px 24px; border: none;
}
.co-modal-header .modal-title { font-weight: 700; font-size: 1rem; }
.co-modal-header .modal-title i { margin-right: 8px; }
.co-modal-close { color: #fff; opacity: 1; font-size: 1.4rem; }
.co-modal-close:hover { color: rgba(255,255,255,0.8); }
.co-modal-body { padding: 24px; }
.co-terms-section { display: flex; flex-direction: column; gap: 14px; }
.co-terms-item {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 14px 16px;
    background: #fffbf0;
    border-radius: 10px; border-left: 3px solid #ffa500;
}
.co-terms-item > i {
    color: #ffa500; font-size: 1rem; margin-top: 3px; flex-shrink: 0;
}
.co-terms-item strong { display: block; color: #222; font-size: 0.88rem; margin-bottom: 3px; }
.co-terms-item p { margin: 0; font-size: 0.82rem; color: #666; line-height: 1.5; }
.co-modal-footer { border: none; padding: 16px 24px; background: #f8f8f8; }
.co-modal-btn {
    background: linear-gradient(135deg, #ff8c00, #ffa500);
    color: #fff; border: none;
    padding: 10px 28px; border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700; font-size: 0.9rem; cursor: pointer;
    transition: all 0.2s;
}
.co-modal-btn:hover { background: linear-gradient(135deg, #e07800, #ff9800); }

/* ---------------------- RESPONSIVE ---------------------- */
@media (max-width: 991px) {
    .co-sticky-summary { position: static; }
    .checkout-hero-title { font-size: 1.9rem; }
}
@media (max-width: 767px) {
    .checkout-hero { padding: 60px 0 35px; }
    .checkout-hero-title { font-size: 1.6rem; }
    .co-card-body { padding: 16px; }
    .co-pay-btn, .co-back-btn { margin-left: 16px; margin-right: 16px; width: calc(100% - 32px); }
    .step-item span { display: none; }
    .checkout-steps { gap: 4px; }
}
</style>
</body>
</html>
@endsection