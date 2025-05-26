@extends('fe.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Minishop - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{  asset ('front-end/css/open-iconic-bootstrap.min.css') }} ">
    <link rel="stylesheet" href="{{  asset ('front-end/css/animate.css') }} ">
    
    <link rel="stylesheet" href="{{  asset ('front-end/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{  asset ('front-end/css/owl.theme.default.min.css') }} ">
    <link rel="stylesheet" href="{{  asset ('front-end/css/magnific-popup.css') }} ">

    <link rel="stylesheet" href="{{  asset ('front-end/css/aos.css') }} ">

    <link rel="stylesheet" href="{{  asset ('front-end/css/ionicons.min.css') }} ">

    <link rel="stylesheet" href="{{  asset ('front-end/css/bootstrap-datepicker.css') }} ">
    <link rel="stylesheet" href="{{  asset ('front-end/css/jquery.timepicker.css') }} ">

    <link rel="stylesheet" href="{{  asset ('front-end/css/flaticon.css') }} ">
    <link rel="stylesheet" href="{{  asset ('front-end/css/icomoon.css') }} ">
    <link rel="stylesheet" href="{{  asset ('front-end/css/style.css') }} ">
</head>

<style>
.uniform-img {
    width: 100%;
    height: 430px;
    object-fit: cover;
    object-position: center;
}

.badge-stok {
    padding: 6px 12px;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    display: inline-block;
}

.stok-ada {
    background-color: #28a745;
}

.stok-habis {
    background-color: #dc3545;
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

.btn-kuning-theme {
    background-color: #f7b731;
    color: #fff;
    border: none;
    transition: all 0.3s ease;
}

.btn-kuning-theme:hover {
    background-color: #f39c12;
    color: #fff;
}
 .custom-btn-keranjang {
        background-color: #28a745;
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        display: inline-block;
        text-align: center;
        margin-right: 10px;
    }

    .custom-btn-keranjang:hover {
        background-color: #218838;
    }

    .custom-btn-kembali {
        background-color: #f0ad4e;
        color: white;
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .custom-btn-kembali:hover {
        background-color: #ec971f;
    }

    @media (max-width: 768px) {
        .custom-btn-keranjang,
        .custom-btn-kembali {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            text-align: center;
        }
    }
</style>

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-0 bread">Product Detail</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="{{ asset('storage/' . $data->foto1) }}" class="image-popup prod-img-bg">
                    <img src="{{ asset('storage/' . $data->foto1) }}" class="img-fluid uniform-img" alt="">
                </a>
            </div>

            <!-- Detail Produk -->
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3>{{ $data->nama_obat }}</h3>
                <h2>{{ $data->jenisObat->jenis }}</h2>
                <img style=" width: 60px;
    height: 60px;
    object-fit: contain;" src="{{ asset('storage/' . $data->jenisObat->image_url) }}" class="img-fluid uniform-img" alt="">
                <p>{{ $data->jenisObat->deskripsi_jenis }}</p>

                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        @for($i = 0; $i < 5; $i++)
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        @endfor
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                    </p>
                </div>

                <p class="price">
                    <span id="harga-dinamis">Rp{{ number_format($data->harga_jual, 0, ',', '.') }}</span>
                </p>

                <!-- Form Add to Cart -->
                
                            @if($data->stok > 0)
<form method="POST" action="{{ route('cart.store') }}">
@endif
    @csrf
    <input type="hidden" name="id_obat" value="{{ $data->id }}">
    
    <div class="row mt-4">
        <div class="input-group col-md-6 d-flex mb-3">
            <span class="input-group-btn mr-2">
                <button type="button" class="quantity-left-minus btn" id="btnMin">
                    <i class="ion-ios-remove"></i>
                </button>
            </span>

            <input type="text" id="quantity" name="quantity" class="quantity form-control input-number" value="1" min="1" max="{{ $data->stok }}" readonly>

            <span class="input-group-btn ml-2">
                <button type="button" class="quantity-right-plus btn" id="btnPlus">
                    <i class="ion-ios-add"></i>
                </button>
            </span>
        </div>

        <div class="w-100"></div>

        <div class="col-md-12">
            @if($data->stok > 0)
                <p><span class="badge-stok stok-ada">Stok: {{ $data->stok }}</span></p>
            @else
                <p><span class="badge-stok stok-habis">Stok Habis</span></p>
            @endif
        </div>
    </div>

@if($data->stok > 0)
    <button style="color: #218838;" type="submit" class="custom-btn-keranjang">
    <span class="badge-stok stok-ada">Tambah Ke Keranjang</span></button>
@endif
<a href="{{ route('shop.index') }}" class="custom-btn-kembali">Kembali</a>

</form>
            </div>
        </div>
    </div>
</section>

<!-- Tabs section tetap -->
<div class="row mt-5">
    <div class="col-md-12 nav-link-wrap">
        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>
        </div>
    </div>
    <div class="col-md-12 tab-wrap">
        <div class="tab-content bg-light" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel">
                <div class="p-4">
                    <h3>{{ $data->nama_obat }}</h3>
                    <p>{{ $data->deskripsi_obat }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{  asset ('front-end/js/jquery.min.js') }}"></script>
<script src="{{  asset ('front-end/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{  asset ('front-end/js/popper.min.js') }} "></script>
<script src="{{  asset ('front-end/js/bootstrap.min.js') }} "></script>
<script src="{{  asset ('front-end/js/jquery.easing.1.3.js') }} "></script>
<script src="{{  asset ('front-end/js/jquery.waypoints.min.js') }} "></script>
<script src="{{  asset ('front-end/js/jquery.stellar.min.js') }} "></script>
<script src="{{  asset ('front-end/js/owl.carousel.min.js') }} "></script>
<script src="{{  asset ('front-end/js/jquery.magnific-popup.min.js') }} "></script>
<script src="{{  asset ('front-end/js/aos.js') }} "></script>
<script src="{{  asset ('front-end/js/jquery.animateNumber.min.js') }} "></script>
<script src="{{  asset ('front-end/js/bootstrap-datepicker.js') }} "></script>
<script src="{{  asset ('front-end/js/scrollax.min.js') }} "></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="{{  asset ('front-end/js/google-map.js') }}"></script>
<script src="{{  asset ('front-end/js/main.js') }} "></script>

<script>
$(document).ready(function(){
    var quantity = 1;
    var harga = parseInt("{{ $data->harga_jual }}");
    var maxStok = parseInt("{{ $data->stok }}");

    function updateHarga(){
        var total = harga * quantity;
        $('#harga-dinamis').text('Rp' + total.toLocaleString('id-ID'));
    }

    function checkButtonVisibility() {
        if (quantity >= maxStok) {
            $('#btnPlus').hide();
        } else {
            $('#btnPlus').show();
        }
    }

    $('#btnPlus').click(function(e){
        e.preventDefault();
        if(quantity < maxStok){
            quantity++;
            $('#quantity').val(quantity);
            updateHarga();
            checkButtonVisibility();
        }
    });

    $('#btnMin').click(function(e){
        e.preventDefault();
        if(quantity > 1){
            quantity--;
            $('#quantity').val(quantity);
            updateHarga();
            checkButtonVisibility();
        }
    });

    $('#quantity').val(quantity);
    updateHarga();
    checkButtonVisibility();
});
</script>

</body>
</html>
@endsection
