@extends('fe.master')


@section('content')
<section id="home-section" class="hero">
			<div class="home-slider owl-carousel">
			<div class="slider-item js-fullheight">
				<div class="overlay"></div>
				<div class="container-fluid p-0">
				<div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
					<img class="one-third order-md-last img-fluid" src="{{ asset ('front-end/images/hmm.webp') }}" alt="" width="60%" height="200px">
					<div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
						<div class="text">
							<div class="horizontal">
								<h1 class="mb-4 mt-3">Koleksi Obat Terlengkap 2025</h1>
								<p class="mb-4">Kami menyediakan berbagai jenis obat terpercaya, dari obat generik hingga obat resep, untuk menunjang kesehatan Anda dan keluarga.</p>
								
								<p><a href="{{ route ('shop.index') }}" class="btn-custom" style="border-radius:50px;">Shop Now</a></p>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>

			<div class="slider-item js-fullheight">
				<div class="overlay"></div>
				<div class="container-fluid p-0">
				<div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
					<img class="one-third order-md-last img-fluid" src="{{ asset ('front-end/images/webe.webp') }}" alt="">
					<div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
						<div class="text">
							<div class="horizontal">
								<h1 class="mb-4 mt-3">Koleksi Obat Terbaru</h1>
								<p class="mb-4">Temukan berbagai pilihan obat berkualitas untuk memenuhi kebutuhan kesehatan Anda. Tersedia obat bebas hingga obat dengan resep dokter.</p>

								
								<p><a href="{{ route ('shop.index') }}" class="btn-custom" style="border-radius:50px;">Shop Now</a></p>
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
			</div>
		</section>

		<section class="ftco-section ftco-no-pt ftco-no-pb">
	<div class="container">
		<div class="row no-gutters ftco-services">

			<div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services p-4 py-md-5">
					<div class="icon d-flex justify-content-center align-items-center mb-4">
						<span class="flaticon-bag"></span>
					</div>
					<div class="media-body">
						<h3 class="heading">Pengiriman terjangkau</h3>
						<p>Nikmati layanan pengiriman terjangkau untuk pembelian obat tertentu, langsung ke rumah Anda dengan aman dan cepat.</p>
					</div>
				</div>      
			</div>

			<div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
				<div class="media block-6 services p-4 py-md-5">
					<div class="icon d-flex justify-content-center align-items-center mb-4">
						<span class="flaticon-customer-service"></span>
					</div>
					<div class="media-body">
						<h3 class="heading">Layanan Konsultasi</h3>
						<p>Tim apoteker kami siap membantu Anda dengan konsultasi terjangkau mengenai penggunaan obat dan resep yang tepat.</p>
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
						<p>Kami menyediakan berbagai metode pembayaran yang aman dan terenkripsi untuk kenyamanan dan keamanan Anda.</p>
					</div>
				</div>      
			</div>

		</div>
	</div>
</section>


		<section class="ftco-section testimony-section">
	<div class="container">
		<div class="row">

			<!-- Layanan Kiri -->
			<div class="col-lg-5">
				<div class="services-flow">

					<div class="services-2 p-4 d-flex ftco-animate">
						<div class="icon">
							<span class="flaticon-bag"></span>
						</div>
						<div class="text">
							<h3>Ongkir Terjangkau</h3>
							<p class="mb-0">Nikmati pengiriman terjangkau untuk pembelian obat tertentu langsung ke alamat Anda.</p>
						</div>
					</div>

					<div class="services-2 p-4 d-flex ftco-animate">
						<div class="icon">
							<span class="flaticon-heart-box"></span>
						</div>
						<div class="text">
							<h3>Promo dan Hadiah</h3>
							<p class="mb-0">Dapatkan berbagai penawaran menarik serta hadiah langsung setiap minggu.</p>
						</div>
					</div>

					<div class="services-2 p-4 d-flex ftco-animate">
						<div class="icon">
							<span class="flaticon-payment-security"></span>
						</div>
						<div class="text">
							<h3>Transaksi Aman</h3>
							<p class="mb-0">Sistem pembayaran kami sudah terenkripsi dan terpercaya untuk kenyamanan Anda.</p>
						</div>
					</div>

					<div class="services-2 p-4 d-flex ftco-animate">
						<div class="icon">
							<span class="flaticon-customer-service"></span>
						</div>
						<div class="text">
							<h3>Dukungan 24 Jam</h3>
							<p class="mb-0">Tim kami siap membantu Anda setiap hari, kapan saja dibutuhkan.</p>
						</div>
					</div>

				</div>
			</div>

			<!-- Penjelasan Kanan -->
			<div class="col-lg-7">
				<div class="heading-section ftco-animate mb-5">
					<h2 class="mb-4">KENAPA HARUS DI BIO PHARM?</h2>
					<p>Bio Pharm adalah solusi terpercaya untuk semua kebutuhan obat Anda. Dengan pengiriman cepat, layanan ramah, serta jaminan kualitas, kami hadir untuk menjaga kesehatan Anda dan keluarga.</p>
				</div>
			</div>

		</div>
	</div>
</section>

@endsection
