@extends('fe.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - Apotek Online</title>
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
    <link rel="stylesheet" href="{{ asset('front-end/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="goto-here">

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('home.index') }}">Beranda</a></span> 
                        <span>Checkout</span>
                    </p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="{{ route('checkout.store') }}" method="POST" id="checkoutForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="has_obat_keras" value="{{ $hasObatKeras ? 'true' : 'false' }}">

                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-orange text-white">
                                <h3 style="color:white;" class="mb-0">Detail Pengiriman</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" value="{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telepon">No. Telepon</label>
                                            <input type="text" class="form-control" name="telepon" value="{{ Auth::guard('pelanggan')->user()->no_telp }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat">Alamat Lengkap</label>
                                            <textarea class="form-control" name="alamat" rows="3" required>{{ Auth::guard('pelanggan')->user()->alamat1 }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="file_resep">Upload Resep Dokter (Wajib untuk Obat Keras)</label>
                                            <div class="input-group mb-2">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('file_resep') is-invalid @enderror" id="file_resep" name="file_resep" accept="image/*">
                                                    <label class="custom-file-label" for="file_resep">Pilih file...</label>
                                                </div>
                                            </div>
                                            @error('file_resep')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <small class="text-muted">Format yang diperbolehkan: .jpg, .jpeg, .png | Maks: 2MB</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-orange text-white">
                                        <h3 style="color:white;" class="mb-0">Metode Pengiriman</h3>
                                    </div>
                                    <div class="card-body">
                                        @foreach($jenisPengiriman as $pengiriman)
                                        <div class="custom-control custom-radio mb-3 shipping-method">
                                            <input type="radio" id="pengiriman{{ $pengiriman->id }}" 
                                                   name="id_jenis_kirim" 
                                                   value="{{ $pengiriman->id }}"
                                                   class="custom-control-input metode-pengiriman"
                                                   data-ongkir="{{ $pengiriman->ongkos_kirim }}"
                                                   required {{ $loop->first ? 'checked' : '' }}>
                                            <label class="custom-control-label d-flex align-items-center" for="pengiriman{{ $pengiriman->id }}">
                                                <div class="shipping-logo-container">
                                                    <img src="{{ asset('storage/' . $pengiriman->logo_ekspedisi) }}" 
                                                         alt="{{ $pengiriman->nama_ekspedisi }}"
                                                         class="shipping-logo">
                                                </div>
                                                <div class="ml-3">
                                                    <strong>{{ $pengiriman->nama_ekspedisi }}</strong><br>
                                                    <small class="text-muted">{{ ucfirst($pengiriman->jenis_kirim) }}</small><br>
                                                    <span class="text-orange font-weight-bold">Rp{{ number_format($pengiriman->ongkos_kirim, 0, ',', '.') }}</span>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-header bg-orange text-white">
                                        <h3 style="color:white;" class="mb-0">Metode Bayar Yang Tersedia</h3>
                                        <h5 style="color:white;" class="mb-0">(Virtual Account Bank)</h5>
                                        {{-- <h6 style="color:white;" class="mb-0">(Silahkan copy No.rek Terlebih dahulu sebelum melanjutkan)</h6> --}}
                                    </div>
                                    <div class="card-body">
                                        @foreach($metodeBayar as $bayar)
                                        <div class="custom-control custom-radio mb-3 payment-method">
                                            <input type="radio" id="pembayaran{{ $bayar->id }}" 
                                                   name="id_metode_bayar" 
                                                   value="{{ $bayar->id }}"
                                                   class="custom-control-input payment-radio"
                                                   required {{ $loop->first ? 'checked' : '' }}>
                                            <label class="custom-control-label d-flex align-items-center" for="pembayaran{{ $bayar->id }}">
                                                <div class="payment-logo-container">
                                                    <img src="{{ asset('storage/' . $bayar->url_logo) }}" 
                                                         alt="{{ $bayar->metode_pembayaran }}"
                                                         class="payment-logo">
                                                </div>
                                                <div class="ml-3">
                                                    <strong>{{ $bayar->metode_pembayaran }}</strong><br>
                                                    <small class="text-muted">{{ $bayar->tempat_bayar }}</small>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-orange text-white">
                                        <h3 style="color:white;" class="mb-0">Ringkasan Pesanan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-orange">
                                                    <tr>
                                                        <th>Produk</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah item</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($cartItems as $item)
                                                    <tr>
                                                        <td>{{ $item->obat->nama_obat }}</td>
                                                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                                        <td>{{ $item->jumlah_order }}</td>
                                                        <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="3">Subtotal</th>
                                                        <th class="subtotal-display">Rp{{ number_format($subtotal, 0, ',', '.') }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">Biaya Aplikasi</th>
                                                        <th class="biaya-app-display">Rp{{ number_format($biayaApp, 0, ',', '.') }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">Ongkos Kirim</th>
                                                        <th class="ongkir-display">Rp{{ number_format($jenisPengiriman->first()->ongkos_kirim ?? 0, 0, ',', '.') }}</th>
                                                    </tr>
                                                    <tr class="table-orange">
                                                        <th colspan="3">Total</th>
                                                        <th class="total-display">Rp{{ number_format($total + ($jenisPengiriman->first()->ongkos_kirim ?? 0), 0, ',', '.') }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        <div class="form-group mt-4">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="agree_terms" name="agree_terms" required>
                                                <label class="custom-control-label" for="agree_terms">
                                                    Saya menyetujui <a href="#" data-toggle="modal" data-target="#termsModal">syarat dan ketentuan</a> yang berlaku
                                                </label>
                                            </div>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-orange-theme py-3 px-5 mr-3" id="submitBtn">
                                                <i class="icon-credit-card"></i> Bayar Sekarang
                                            </button>
                                            <a href="{{ route('cart.index') }}" class="btn btn-outline-orange py-3 px-5">
                                                <i class="icon-shopping-cart"></i> Kembali ke Keranjang
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-orange text-white">
                    <h5 class="modal-title" id="termsModalLabel">Syarat dan Ketentuan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-orange" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script>
    $(document).ready(function(){
        // Track if account number has been copied
        let hasCopiedAccount = false;
        let currentPaymentMethod = $('input[name="id_metode_bayar"]:checked').val();

        // Update custom file input label
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Fungsi untuk update total
        function updateTotal() {
            let subtotal = parseFloat("{{ $subtotal }}");
            let biayaApp = parseFloat("{{ $biayaApp }}");
            let ongkir = parseFloat($('input[name="id_jenis_kirim"]:checked').data('ongkir')) || 0;
            let total = subtotal + biayaApp + ongkir;
            
            // Update tampilan
            $('.subtotal-display').text('Rp' + subtotal.toLocaleString('id-ID'));
            $('.biaya-app-display').text('Rp' + biayaApp.toLocaleString('id-ID'));
            $('.ongkir-display').text('Rp' + ongkir.toLocaleString('id-ID'));
            $('.total-display').text('Rp' + total.toLocaleString('id-ID'));
        }

        // Event ketika metode pengiriman berubah
        $('input[name="id_jenis_kirim"]').change(updateTotal);

        // Event ketika metode pembayaran berubah
        $('input[name="id_metode_bayar"]').change(function() {
            currentPaymentMethod = $(this).val();
            // Reset copied status when payment method changes
            hasCopiedAccount = false;
            localStorage.removeItem('hasCopiedAccount');
        });

        // Validasi URL Resep

        // Validasi form sebelum submit
        $('#checkoutForm').on('submit', function(e) {

            if (!$('input[name="agree_terms"]:checked').length) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Persetujuan Wajib',
                    text: 'Anda harus menyetujui syarat dan ketentuan',
                });
                return false;
            }

        });

        // Inisialisasi pertama kali
        updateTotal();
    });
    </script>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    // Fungsi untuk menangani pembayaran dengan Midtrans
    function payWithMidtrans(snapToken) {
        snap.pay(snapToken, {
            // Optional
            onSuccess: function(result) {
                console.log('Payment success', result);
                window.location.href = "{{ route('pesanan.index') }}";
            },
            // Optional
            onPending: function(result) {
                console.log('Payment pending', result);
                window.location.href = "{{ route('pesanan.index') }}";
            },
            // Optional
            onError: function(result) {
                console.log('Payment error', result);
                window.location.href = "{{ route('checkout.index') }}";
            }
        });
    }
</script>

    <style>            
    /* Orange Theme */
    .bg-orange {
        background-color:#ffa500 !important;
    }
    
    .btn-orange {
        background-color:#ffa500;
        color: white;
        border: none;
    }
    
    .btn-orange:hover {
        background-color: #E05D00;
        color: white;
    }
    
    .btn-outline-orange {
        color:#ffa500;
        border-color:#ffa500;
    }
    
    .btn-outline-orange:hover {
        background-color:#ffa500;
        color: white;
    }
    
    .btn-orange-theme {
        background-color:#ffa500;
        color: #fff;
        border: none;
        transition: all 0.3s ease;
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 4px;
        box-shadow: 0 4px 6px rgba(255, 107, 0, 0.2);
    }

    .btn-orange-theme:hover {
        background-color: #E05D00;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(255, 107, 0, 0.3);
    }

    .text-orange {
        color:#ffa500 !important;
    }
    
    .table-orange {
        background-color: rgba(255, 107, 0, 0.1);
    }
    
    .thead-orange th {
        background-color:#ffa500;
        color: white;
    }
    
    /* Modern Card Styles */
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .card-header {
        border-bottom: none;
        font-weight: 600;
    }
    
    /* Payment Method Styles */
    .payment-method {
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #eee;
        transition: all 0.3s ease;
    }
    
    .payment-method:hover {
        border-color:#ffa500;
        background-color: rgba(255, 107, 0, 0.05);
    }
    
    .payment-logo-container {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 8px;
        padding: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .payment-logo {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    
    /* Shipping Method Styles */
    .shipping-method {
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #eee;
        transition: all 0.3s ease;
    }
    
    .shipping-method:hover {
        border-color:#ffa500;
        background-color: rgba(255, 107, 0, 0.05);
    }
    
    .shipping-logo-container {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border-radius: 8px;
        padding: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .shipping-logo {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    
    /* Custom Checkbox */
    .custom-control-input:checked~.custom-control-label::before {
        background-color:#ffa500;
        border-color:#ffa500;
    }
    
    /* Form Styles */
    .form-control:focus {
        border-color:#ffa500;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
    }
    
    .custom-file-input:focus~.custom-file-label {
        border-color:#ffa500;
        box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
    }
    
    .custom-file-label::after {
        background-color:#ffa500;
        color: white;
        border-left: none;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .btn-orange-theme, .btn-outline-orange {
            width: 100%;
            margin-bottom: 10px;
        }
    }
    </style>
</body>
</html>
@endsection