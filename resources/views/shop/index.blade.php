@extends('fe.master')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Minishop - Free Bootstrap 4 Template by Colorlib</title>
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
</head>

<style>
    .uniform-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        object-position: center;
    }
</style>

<body class="goto-here">
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">3-5 Business days delivery &amp; Free Returns</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center mb-3">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">Shop</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('shop.index') }}" method="GET" class="d-flex mb-4">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari berdasarkan nama obat"
                    class="form-control me-2 p-3 rounded-start border" style="flex: 1;">
                <button type="submit" class="btn btn-primary px-4 rounded-end">Cari</button>
            </form>
        </div>
    </div>

    <section class="ftco-section bg-light">
        <div class="container">
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
    @if($obats->isEmpty())
        <div class="col-12 text-center">
            <h5>Obat yang Anda cari tidak ditemukan atau tidak ada,
            <P>Silahkan periksa kembali nama obat yang di cari.</P></h5>
        </div>
    @else
        @foreach ($obats as $obat)
            <div class="col-sm-12 col-md-12 col-lg-4 ftco-animate d-flex">
                <div class="product d-flex flex-column">
                    @auth('pelanggan')
                        <a href="{{ route('product-detail.show', $obat->id) }}" class="img-prod">
                    @else
                        <a href="#" onclick="return promptLogin()" class="img-prod">
                    @endauth
                        <img class="img-fluid uniform-img" src="{{ asset('storage/' . $obat->foto1) }}" alt="{{ $obat->nama_obat }}">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3">
                        <h3>
                            @auth('pelanggan')
                                <a href="{{ route('product-detail.show', $obat->id) }}">{{ $obat->nama_obat }}</a>
                            @else
                                <a href="#" onclick="return promptLogin()">{{ $obat->nama_obat }}</a>
                            @endauth
                        </h3>
                        <p>{{ $obat->jenisObat->deskripsi_jenis }}</p>
                        <div class="pricing">
                            <p class="price"><span>{{ 'Rp ' . number_format($obat->harga_jual, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>


<!-- SweetAlert script -->
<script>
function promptLogin() {
    Swal.fire({
        title: 'Login Diperlukan',
        text: 'Silakan login terlebih dahulu untuk melihat detail produk!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Login',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('pelanggan.login') }}";
        }
    });
    return false;
}
</script>

        </div>
    </section>

    <script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('front-end/js/popper.min.js') }}"></script>
    <script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('front-end/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front-end/js/aos.js') }}"></script>
    <script src="{{ asset('front-end/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('front-end/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('front-end/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor"></script>
    <script src="{{ asset('front-end/js/google-map.js') }}"></script>
    <script src="{{ asset('front-end/js/main.js') }}"></script>
</body>
</html>
@endsection
