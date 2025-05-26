@extends('fe.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="{{ asset('front-end/css/style.css') }}">
  <style>
    .bg-gradient-orange {
        background: linear-gradient(to right, #f7b731, #f39c12, #e67e22);
        color: white;
    }

    .contact-form {
        background-color: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        transition: 0.3s;
    }

    .contact-form:hover {
        transform: translateY(-5px);
    }

    .contact-info-box {
        background: #fff;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        transition: 0.3s;
    }

    .contact-info-box:hover {
        background-color: #fdf1e3;
    }

    .contact-icon {
        font-size: 30px;
        margin-right: 15px;
        color: #f39c12;
    }

    .hero-wrap {
        background-size: cover;
        background-position: center;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero-wrap h1 {
        color: white;
        font-weight: 700;
        font-size: 48px;
        text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    }

    .form-control:focus {
        border-color: #f39c12;
        box-shadow: 0 0 0 0.2rem rgba(243, 156, 18, 0.25);
    }

    .btn-orange {
        background-color: #f39c12;
        border-color: #f39c12;
        color: white;
        transition: 0.3s;
    }

    .btn-orange:hover {
        background-color: #e67e22;
        border-color: #e67e22;
    }
  </style>
</head>

<body class="goto-here">

<div class="hero-wrap hero-bread" style="background-image: url('{{ asset('images/bg_6.jpg') }}');">
    <div class="container">
        <h1 class="mb-0 bread" style="color: black;">Contact Us</h1>
        <h5 style="font-weight:bold" class="mb-0 bread" style="color: black;">"Anda juga bisa mengirimi kami saran dan kritik anda lewat sini"</h5>
    </div>
</div>


<section class="ftco-section bg-gradient-orange">
  <div class="container">
    <div class="row align-items-stretch">
      <!-- Form Contact -->
      <div class="col-md-6">
        <form action="{{ route('kontak.store') }}" method="POST" class="contact-form shadow-lg">
          @csrf
          <h2 class="mb-4 text-dark font-weight-bold">Send Us a Message</h2>
          <div class="form-group">
            <input type="text" name="nama" class="form-control rounded-3" placeholder="Your Name" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control rounded-3" placeholder="Your Email" required>
          </div>
          <div class="form-group">
            <input type="text" name="subjek" class="form-control rounded-3" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea name="pesan" cols="30" rows="6" class="form-control rounded-3" placeholder="Your Message" required></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-orange py-2 px-4 rounded-3">Send Message</button>
          </div>
      </form>

      </div>

      <!-- Contact Info -->
      <div class="col-md-6">
    <div class="contact-info-box">
        <span class="icon-map-marker contact-icon"></span>
        <div>
                <a style="font-weight: bold;" href="https://www.google.com/maps/place/Cibinong,+Bogor" target="_blank" class="text-dark">Address/Alamat</a>
            <p>
                <a href="https://www.google.com/maps/place/Cibinong,+Bogor" target="_blank" class="text-dark">
                    Indonesia, Jawa Barat, Kab.bogor, Cibinong
                </a>
            </p>
        </div>
    </div>
    <div class="contact-info-box">
        <span class="icon-phone contact-icon"></span>
        <div>
                <a style="font-weight: bold;" href="tel:+6281318614646" class="text-dark">
                    Phone number/Telepon
                </a>
            <p>
                <a href="tel:+6281318614646" class="text-dark">
                    +6281318614646
                </a>
            </p>
        </div>
    </div>
    <div class="contact-info-box">
        <span class="icon-envelope contact-icon"></span>
        <div>
              <a style="font-weight: bold;" href="https://mail.google.com/mail/?view=cm&to=info@biopharm.com" target="_blank" class="text-dark">
                    Gmail
                </a>
            <p>
                <a href="https://mail.google.com/mail/?view=cm&to=info@biopharm.com" target="_blank" class="text-dark">
                    info@biopharm.com
                </a>
            </p>
        </div>
    </div>

        <div class="contact-info-box">
          <span class="icon-globe contact-icon"></span>
          <div>
            <a style="font-weight: bold;" href="{{ route('home.index') }}" class="text-dark">Website</a>
            <p><a href="{{ route('home.index') }}" class="text-dark">www.biopharm.com</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Scripts -->
<script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
<script src="{{ asset('front-end/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front-end/js/aos.js') }}"></script>
<script>
  AOS.init();
</script>

</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  AOS.init();

  @if(session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Pesan Terkirim!',
      text: "Pesan Anda telah terkirim! 'KARYAWAN' Kami akan segera menghubungi Anda.",
      confirmButtonColor: '#f39c12'
    });
  @endif
</script>


@endsection
