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
    background-color: #FFA500; /* Custom Orange color */
}

.text-white {
    color: white !important;
}

.btn-warning {
    background-color: #FF6600; /* Slightly deeper orange */
    border-color: #FF6600;
}

.btn-warning:hover {
    background-color: #e65c00; /* Darker orange on hover */
    border-color: #e65c00;
}
</style>
	
	<body class="goto-here">
		
		@if ($title === 'Edit Profile')
			
		@elseif ($title === 'detail_penjualan')

		@else
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home.index') }}" style="font-size: 30px;">BIO PHARM</a>
			
			<!-- Tombol Hamburger -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Tombol X manual -->
				<button id="close-navbar" class="btn btn-danger d-lg-none ml-2" style="font-size: 20px;">&times;</button>

				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

			<script>
				document.getElementById('close-navbar').addEventListener('click', function () {
					const nav = document.getElementById('ftco-nav');
					if (nav.classList.contains('show')) {
						nav.classList.remove('show'); // Bootstrap 4: menutup navbar
					}
				});
			</script>
		@endif

        <div class="collapse navbar-collapse" id="ftco-nav" style="padding-top:30px;">
            <ul class="navbar-nav ml-auto" >
                <li class="nav-item {{ Request::routeIs('home.index') ? 'active' : '' }}">
						<a href="{{ route('home.index') }}" class="nav-link" style="font-size: 15px; {{ Request::routeIs('home.index') ? 'color: orange;' : '' }}">HOME</a>
					</li>
					<li class="nav-item {{ Request::routeIs('about.index') ? 'active' : '' }}">
						<a href="{{ route('about.index') }}" class="nav-link" style="font-size: 15px; {{ Request::routeIs('about.index') ? 'color: orange;' : '' }}">ABOUT</a>
					</li>
					<li class="nav-item {{ Request::routeIs('contact.index') ? 'active' : '' }}">
						<a href="{{ route('contact.index') }}" class="nav-link" style="font-size: 15px; {{ Request::routeIs('contact.index') ? 'color: orange;' : '' }}">CONTACT</a>
					</li>
					<li class="nav-item {{ Request::routeIs('shop.index') ? 'active' : '' }}">
						<a href="{{ route('shop.index') }}" class="nav-link" style="font-size: 15px; {{ Request::routeIs('shop.index') ? 'color: orange;' : '' }}">SHOP</a>
					</li>

					@if (Auth::guard('pelanggan')->check())
						<li class="nav-item {{ Request::routeIs('pesanan.index') ? 'active' : '' }}">
							<a href="{{ route('pesanan.index') }}" class="nav-link" style="font-size: 15px; {{ Request::routeIs('pesanan.index') ? 'color: orange;' : '' }}">Pesanan</a>
						</li>
						<li class="nav-item {{ Request::routeIs('profile.index') ? 'active' : '' }}">
							<a href="{{ route('profile.index') }}" class="nav-link" style="font-size: 15px; {{ Request::routeIs('profile.index') ? 'color: orange;' : '' }}">PROFILE SAYA</a>
    					</li>

                    <li class="nav-item cta cta-colored">
                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <span class="icon-shopping_cart" style="font-size: 15px;"></span>
                        </a>
                    </li>

                    <!-- Dropdown Profil -->
					<li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
						<a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
							<img class="img-xs rounded-circle ms-2" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->foto) }}" alt="Profile image">
							<span class="font-weight-normal">{{ Auth::guard('pelanggan')->user()->name }}</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown"
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
                @endif
            </ul>
        </div>
    </div>
</nav>



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

				<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
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
	</body>
	</html>