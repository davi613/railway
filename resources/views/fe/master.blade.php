<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $title }}</title>
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
.bg-orange {
    background-color: #FFA500;
}

.text-white {
    color: white !important;
}

.btn-warning {
    background-color: #FF6600;
    border-color: #FF6600;
}

.btn-warning:hover {
    background-color: #e65c00;
    border-color: #e65c00;
}

/* Style untuk tombol login */
.btn-login {
    font-size: 15px;
    color: white !important;
    border: 1px solid orange;
    border-radius: 5px;
    padding: 8px 15px;
    margin-left: 10px;
    transition: all 0.3s ease;
}

.btn-login:hover {
    background-color: orange !important;
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(255, 165, 0, 0.3);
}

/* Navbar putih konsisten */
.ftco_navbar {
    background-color: white !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    transition: all 0.3s ease;
}

body {
    padding-top: 80px;
}

.ftco_navbar .navbar-brand {
    color: #333 !important;
    font-weight: bold;
}

.ftco_navbar .nav-link {
    color: #555 !important;
    font-weight: 500;
}

.ftco_navbar .nav-link:hover {
    color: orange !important;
}

.ftco_navbar .nav-item.active .nav-link {
    color: orange !important;
}

/* Style untuk hamburger menu */
.navbar-toggler {
    border: none !important; /* Hapus border */
    padding: 8px 12px;
    background-color: white;
    outline: none !important;
    box-shadow: none !important;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(100, 100, 100, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
    width: 25px;
    height: 25px;
}

.navbar-toggler:hover {
    background-color: #f5f5f5;
}

.navbar-toggler:focus {
    outline: none;
    box-shadow: none;
}

/* Mobile Navigation - Fullscreen putih */
@media (max-width: 991.98px) {
    .navbar-collapse {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%; /* Fullscreen */
        height: 100vh !important;
        background: white !important;
        padding: 80px 20px 20px !important;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        box-shadow: none; /* Hapus shadow jika tidak perlu */
        z-index: 9998;
        overflow-y: auto;
    }
    
    .navbar-collapse.show {
        transform: translateX(0);
    }
    
    /* Hapus overlay abu-abu */
    .navbar-collapse.show::before {
        display: none;
    }
    
    /* Pastikan semua elemen di dalam menu memiliki background putih */
    .navbar-collapse,
    .navbar-collapse .navbar-nav,
    .navbar-collapse .nav-item,
    .navbar-collapse .nav-link {
        background-color: white !important;
    }
    
    .navbar-nav {
        flex-direction: column;
        width: 100%;
    }
    
    .nav-item {
        width: 100%;
        margin: 5px 0;
    }
    
    .nav-link {
        padding: 12px 15px !important;
        border-radius: 5px;
        color: #333 !important;
    }
    
    .nav-link:hover {
        background: #f5f5f5;
        color: orange !important;
    }
    
    .navbar-toggler {
        position: relative;
        z-index: 10000;
        margin-left: auto;
        background-color: white;
    }
    
    /* Style untuk dropdown di mobile */
    .dropdown-menu {
        background: #f8f9fa !important;
        border: 1px solid #ddd;
        margin-top: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .dropdown-item {
        color: #333 !important;
    }
    
    .dropdown-item:hover {
        background: #e9ecef !important;
        color: orange !important;
    }
    
    /* Style untuk tombol login di mobile */
    .btn-login {
        display: block;
        margin-left: 0 !important;
        text-align: center;
        color: orange !important;
        border-color: orange;
    }
    
    .navbar-nav .nav-link.btn-login:hover {
        background-color: orange !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 165, 0, 0.3);
    }
}

/* Style untuk cart icon */
.cta-colored .nav-link {
    color: #555 !important;
    font-size: 18px !important;
}

.cta-colored .nav-link:hover {
    color: orange !important;
}

/* Style untuk dropdown profile */
.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.dropdown-header p {
    color: #333 !important;
}

/* Hapus background hitam saat scroll */
.ftco-navbar-light.scrolled {
    background-color: white !important;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}
</style>

<body class="goto-here">
    
    @if ($title === 'Edit Profile')
        
    @elseif ($title === 'detail_penjualan')

    @else
<nav class="navbar navbar-expand-lg navbar-light ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}" style="font-size: 30px; color: #333;">BIO PHARM</a>
        
        <!-- Hanya satu tombol toggle dengan warna abu-abu yang jelas -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ Request::routeIs('home.index') ? 'active' : '' }}">
                    <a href="{{ route('home.index') }}" class="nav-link" style="font-size: 15px;">HOME</a>
                </li>
                <li class="nav-item {{ Request::routeIs('about.index') ? 'active' : '' }}">
                    <a href="{{ route('about.index') }}" class="nav-link" style="font-size: 15px;">ABOUT</a>
                </li>
                <li class="nav-item {{ Request::routeIs('contact.index') ? 'active' : '' }}">
                    <a href="{{ route('contact.index') }}" class="nav-link" style="font-size: 15px;">CONTACT</a>
                </li>
                <li class="nav-item {{ Request::routeIs('shop.index') ? 'active' : '' }}">
                    <a href="{{ route('shop.index') }}" class="nav-link" style="font-size: 15px;">SHOP</a>
                </li>

                @if (Auth::guard('pelanggan')->check())
                    <li class="nav-item {{ Request::routeIs('pesanan.index') ? 'active' : '' }}">
                        <a href="{{ route('pesanan.index') }}" class="nav-link" style="font-size: 15px;">Pesanan</a>
                    </li>

                    <li class="nav-item cta cta-colored">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <span class="icon-shopping_cart" style="font-size: 15px;"></span>
                        </a>
                    </li>

                    <!-- Dropdown Profil -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <img class="img-xs rounded-circle ms-2" style="width: 30px; height: 30px; object-fit: cover;" src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto) }}" alt="Profile image">
                            <span class="font-weight-normal">{{ Auth::guard('pelanggan')->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="UserDropdown"
                            style="background-color: #f8f9fa; border-radius: 12px; padding: 15px;">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto) }}" alt="Profile image">
                                <p style="color: orange;" class="mb-1 mt-3">{{ Auth::guard('pelanggan')->user()->nama_pelanggan }}</p>
                                <p style="color: orange;" class="mb-1">{{ Auth::guard('pelanggan')->user()->email }}</p>
                            </div>
                            <a style="background-color: #00A36C; color: white;" href="{{ route('profile.index') }}" class="btn btn-warning w-100 mt-3">Profile</a>
                            <form action="{{ route('pelanggan.logout') }}" method="POST">
                                @csrf
                                <button style="background-color: yellow;" type="submit" class="btn btn-warning w-100 mt-3">Logout</button>
                            </form>
                        </div>
                    </li>
                @else
                    <!-- Tombol Login untuk pelanggan yang belum login dengan hover effect -->
                    <li style="color:black;" class="nav-item">
                        <a href="{{ route('pelanggan.login') }}" class="nav-link btn-login">LOGIN</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
    @endif

    @yield('content')
    
    <footer class="ftco-footer ftco-section">
    <div class="container">
        <div class="row">
            <div class="mouse">
                <a href="#" class="mouse-icon">
                    <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                </a>
            </div>
        </div>
        <div class="row mb-5">
        <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Bio Pharm</h2>
            <p>Bio Pharm adalah solusi terpercaya untuk semua kebutuhan obat Anda. Dengan pengiriman cepat, layanan ramah, serta jaminan kualitas, kami hadir untuk menjaga kesehatan Anda dan keluarga</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="https://x.com/pharmacy_times"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="https://www.facebook.com/?locale=id_ID"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="https://www.instagram.com/pharmacytimes/"><span class="icon-instagram"></span></a></li>
            </ul>
            </div>
        </div>
        <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
            <h2 class="ftco-heading-2">Menu</h2>
            <ul class="list-unstyled">
                <li><a href="{{ route ('shop.index') }}" class="py-2 d-block">Shop</a></li>
                <li><a href="{{ route ('about.index') }}" class="py-2 d-block">About</a></li>
                <li><a href="{{ route('home.index') }}" class="py-2 d-block">Journal</a></li>
                <li><a href="{{ route('contact.index') }}" class="py-2 d-block">Contact Us</a></li>
            </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Help</h2>
            <div class="d-flex">
                <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                    <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
                    <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
                    <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
                    <li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
                </ul>
                <ul class="list-unstyled">
                    <li><a href="#" class="py-2 d-block">FAQs</a></li>
                    <li><a href="#" class="py-2 d-block">Contact</a></li>
                </ul>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="col-md-6">

        <span class="icon-map-marker contact-icon"></span>
        <div>
            <a style="font-weight: bold;" href="https://www.google.com/maps/place/Cibinong,+Bogor" target="_blank" class="text-light">Address/Alamat</a>
            <p>
                <a href="https://www.google.com/maps/place/Cibinong,+Bogor" target="_blank" class="text-light">
                    Indonesia, Jawa Barat, Kab. Bogor, Cibinong
                </a>
            </p>
        </div>

        <span class="icon-phone contact-icon"></span>
        <div>
            <a style="font-weight: bold;" href="tel:+1235235598" class="text-light">Phone number/Telepon</a>
            <p>
                <a href="tel:+1235235598" class="text-light">+62 235 2355 98</a>
            </p>
        </div>

        <span class="icon-envelope contact-icon"></span>
        <div>
            <a style="font-weight: bold;" href="https://mail.google.com/mail/?view=cm&to=info@biopharm.com" target="_blank" class="text-light">Gmail</a>
            <p>
                <a href="https://mail.google.com/mail/?view=cm&to=info@biopharm.com" target="_blank" class="text-light">info@biopharm.com</a>
            </p>
        </div>
    </div>

        </div>
        </div>
        <div class="row">
        <div class="col-md-12 text-center">

            <p>
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        </p>
        </div>
        </div>
    </div>
    </footer>
    
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- loader -->
    {{-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> --}}

    <script src="front-end/js/jquery.min.js"></script>
    <script src="front-end/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="front-end/js/popper.min.js"></script>
    <script src="front-end/js/bootstrap.min.js"></script>
    <script src="front-end/js/jquery.easing.1.3.js"></script>
    <script src="front-end/js/jquery.waypoints.min.js"></script>
    <script src="front-end/js/jquery.stellar.min.js"></script>
    <script src="front-end/js/owl.carousel.min.js"></script>
    <script src="front-end/js/jquery.magnific-popup.min.js"></script>
    <script src="front-end/js/aos.js"></script>
    <script src="front-end/js/jquery.animateNumber.min.js"></script>
    <script src="front-end/js/bootstrap-datepicker.js"></script>
    <script src="front-end/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="front-end/js/google-map.js"></script>
    <script src="front-end/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Script tambahan untuk menutup menu saat klik di luar -->
    <script>
    $(document).ready(function() {
        // Tutup menu saat klik di luar
        $(document).on('click', function(event) {
            var $target = $(event.target);
            var $navbar = $('.navbar-collapse');
            var $toggler = $('.navbar-toggler');
            
            if (!$target.closest('.navbar-collapse').length && !$target.closest('.navbar-toggler').length && $navbar.hasClass('show')) {
                $navbar.collapse('hide');
            }
        });
        
        // Tutup menu saat klik link di dalam navbar
        $('.navbar-nav .nav-link').on('click', function() {
            if ($(window).width() <= 991.98) {
                $('.navbar-collapse').collapse('hide');
            }
        });

        // Fix untuk menghilangkan background hitam saat scroll
        $(window).scroll(function() {
            if ($(window).scrollTop() > 0) {
                $('.ftco-navbar-light').addClass('scrolled');
            } else {
                $('.ftco-navbar-light').removeClass('scrolled');
            }
        });
    });
    </script>
</body>
</html>