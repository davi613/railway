@extends('fe.master')
@section('content')

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Minishop - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset ('css/open-iconic-bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{ asset ('css/animate.css') }} ">
    
    <link rel="stylesheet" href="{{ asset ('css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset ('css/owl.theme.default.min.css') }} ">
    <link rel="stylesheet" href="{{ asset ('css/magnific-popup.css') }} ">

    <link rel="stylesheet" href="{{ asset ('css/aos.css') }} ">

    <link rel="stylesheet" href="{{ asset ('css/ionicons.min.css') }} ">

    <link rel="stylesheet" href="{{ asset ('css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="{{ asset ('css/jquery.timepicker.css') }} ">

    
    <link rel="stylesheet" href="{{ asset ('css/flaticon.css') }} ">
    <link rel="stylesheet" href="{{ asset ('css/icomoon.css') }} ">
    <link rel="stylesheet" href="{{ asset ('css/style.css') }} ">
  </head>
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
                            <span class="text">Pengiriman dalam 3-5 hari kerja &amp; Pengembalian Gratis</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">Tentang Kami</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row no-gutters ftco-services">
                <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services p-4 py-md-5">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                            <span class="flaticon-bag"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Pengiriman Terjangkau</h3>
                            <p>Nikmati pengiriman terjangkau untuk semua pesanan, memastikan barang Anda sampai dengan aman dan tepat waktu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services p-4 py-md-5">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Dukungan Pelanggan</h3>
                            <p>Kami menawarkan dukungan khusus untuk membantu Anda dengan pertanyaan atau masalah yang mungkin Anda hadapi di setiap tahap.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services p-4 py-md-5">
                        <div class="icon d-flex justify-content-center align-items-center mb-4">
                            <span class="flaticon-payment-security"></span>
                        </div>
                        <div class="media-body">
                            <h3 class="heading">Pembayaran Aman</h3>
                            <p>Kami menjamin transaksi Anda dengan sistem pembayaran yang aman dan terlindungi setiap saat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
        <div class="container">
            <div class="row">
              <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(front-end/images/sc.png);">
                  <a href="https://www.youtube.com/watch?v=Q9Qy7ioynQ8" class="icon popup-youtube d-flex justify-content-center align-items-center">
                      <span class="icon-play"></span>
                  </a>
              </div>



                <div class="col-md-7 py-md-5 wrap-about pb-md-5 ftco-animate">
                    <div class="heading-section-bold mb-4 mt-md-5">
                        <div class="ml-md-0">
                            <h2 class="mb-4">Didirikan Sejak 2015</h2>
                        </div>
                    </div>
                    <div class="pb-md-5 pb-4">
                        <p>Perjalanan kami dimulai dengan visi untuk memberikan pelayanan terbaik dan pengalaman belanja yang memuaskan.</p>
                        <p>Sejak saat itu, kami terus berkembang dan berkomitmen untuk menyediakan produk dan layanan yang unggul.</p>
                        <p><a href="{{ route ('shop.index') }}" class="btn btn-primary">Belanja Sekarang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="services-flow">
                        <div class="services-2 p-4 d-flex ftco-animate">
                            <div class="icon">
                                <span class="flaticon-bag"></span>
                            </div>
                            <div class="text">
                                <h3>Pengiriman Terjangkau</h3>
                                <p class="mb-0">Kami menawarkan pengiriman Terjangkau untuk semua pesanan Anda.</p>
                            </div>
                        </div>
                        <div class="services-2 p-4 d-flex ftco-animate">
                            <div class="icon">
                                <span class="flaticon-heart-box"></span>
                            </div>
                            <div class="text">
                                <h3>Hadiah Berharga</h3>
                                <p class="mb-0">Nikmati hadiah menarik setiap kali Anda berbelanja.</p>
                            </div>
                        </div>
                        <div class="services-2 p-4 d-flex ftco-animate">
                            <div class="icon">
                                <span class="flaticon-payment-security"></span>
                            </div>
                            <div class="text">
                                <h3>Dukungan Sepanjang Hari</h3>
                                <p class="mb-0">Kami siap membantu Anda kapan saja dengan layanan pelanggan yang siap sedia.</p>
                            </div>
                        </div>
                        <div class="services-2 p-4 d-flex ftco-animate">
                            <div class="icon">
                                <span class="flaticon-customer-service"></span>
                            </div>
                            <div class="text">
                                <h3>Support 24/7</h3>
                                <p class="mb-0">Tim kami siap memberikan dukungan kapan saja jika Anda membutuhkan bantuan.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="heading-section ftco-animate mb-5">
                        <h2 class="mb-4">Apa Kata Pelanggan Kami</h2>
                        <p>Berikut adalah beberapa pendapat pelanggan yang puas dengan layanan dan produk kami.</p>
                    </div>
                        <div class="carousel-testimony owl-carousel ftco-animate">
                            @foreach ($kontaks as $kontak)
                                <div class="item">
                                    <div class="testimony-wrap">
                                        <div class="user-img mb-4" style="background-image: url(front-end/images/abouts.svg)">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text">
                                            <p class="mb-4 pl-4 line">"{{ $kontak->pesan }}"</p>
                                            <p class="name">{{ $kontak->nama }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                </div>
            </div>
        </div>
    </section>
</body>

    
  

  <!-- loader -->
  {{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> --}}


  <script src="{{ asset ('js/jquery.min.js') }} "></script>
  <script src="{{ asset ('js/jquery-migrate-3.0.1.min.js') }} "></script>
  <script src="{{ asset ('js/popper.min.js') }} "></script>
  <script src="{{ asset ('js/bootstrap.min.js') }} "></script>
  <script src="{{ asset ('js/jquery.easing.1.3.js') }} "></script>
  <script src="{{ asset ('js/jquery.waypoints.min.js') }} "></script>
  <script src="{{ asset ('js/jquery.stellar.min.js') }} "></script>
  <script src="{{ asset ('js/owl.carousel.min.js') }} "></script>
  <script src="{{ asset ('js/jquery.magnific-popup.min.js') }} "></script>
  <script src="{{ asset ('js/aos.js') }} "></script>
  <script src="{{ asset ('js/jquery.animateNumber.min.js') }} "></script>
  <script src="{{ asset ('js/bootstrap-datepicker.js') }} "></script>
  <script src="{{ asset ('js/scrollax.min.js') }} "></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset ('js/google-map.js') }} "></script>
  <script src="{{ asset ('js/main.js') }} "></script>
    
  </body>
</html>

<script>
    $(document).ready(function() {
        $('.popup-youtube').magnificPopup({
            type: 'iframe',
            iframe: {
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: function(url) {
                            var match = url.match(/[\\?\\&]v=([^\\?\\&]+)/);
                            return match && match[1] ? match[1] : null;
                        },
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    }
                }
            }
        });
    });
</script>


@endsection