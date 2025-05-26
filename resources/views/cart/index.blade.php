@extends('fe.master')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Keranjang Belanja</title>
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
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        @if($cartItems->count() > 0)
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr class="text-center">
                                        <td class="product-remove">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background: none; border: none; cursor: pointer;">
                                                    <span class="ion-ios-close"></span>
                                                </button>
                                            </form>
                                        </td>
                                        
                                        <td class="image-prod">
                                            <div class="img" style="background-image:url({{ asset('storage/' . $item->obat->foto1) }});"></div>
                                        </td>
                                        
                                        <td class="product-name">
                                            <h3>{{ $item->obat->nama_obat }}</h3>
                                            <p>{{ $item->obat->jenisObat->jenis }}</p>
                                        </td>
                                        
                                        <td class="price">Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        
                                        <td class="quantity">
                                            <div class="input-group mb-3">
                                                <input type="number" name="quantity" class="quantity form-control input-number" 
                                                    value="{{ $item->jumlah_order }}" min="1" 
                                                    data-id="{{ $item->id }}" 
                                                    data-price="{{ $item->harga }}">
                                            </div>
                                        </td>
                                        
                                        <td class="total">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info text-center">
                                Keranjang belanja Kamu Masih kosong. <a href="{{ route('shop.index') }}">Mulai belanja</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            @if($cartItems->count() > 0)
            <div class="row justify-content-start">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>Rp0</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>Rp0</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </p>
                    </div>
                    <p class="text-center">
                        <a href="{{ route('checkout.index') }}" class="btn btn-hijau-theme py-3 px-5 mr-2">Proceed to Checkout</a>
                        <a href="{{ route('shop.index') }}" class="btn btn-kuning-theme py-3 px-5 mr-2">Kembali</a>
                    </p>
                </div>
            </div>
            @endif
        </div>
    </section>

    <script src="{{ asset('front-end/js/jquery.min.js') }}"></script>
    <script>
    $(document).ready(function(){
        // Update quantity
        $('.quantity').on('change', function(){
            var id = $(this).data('id');
            var quantity = $(this).val();
            var price = $(this).data('price');
            
            $.ajax({
                url: "{{ route('cart.update', '') }}/" + id,
                method: 'PATCH',
                data: {
                    _token: "{{ csrf_token() }}",
                    quantity: quantity
                },
                success: function(response){
                    if(response.success){
                        // Update subtotal for this item
                        var subtotal = price * quantity;
                        $(this).closest('tr').find('.total').text('Rp' + subtotal.toLocaleString('id-ID'));
                        
                        // Update all totals in the response
                        $('p.d-flex span:last-child').eq(0).text('Rp' + response.total.toLocaleString('id-ID'));
                        $('p.d-flex.total-price span:last-child').text('Rp' + response.total.toLocaleString('id-ID'));
                        
                        location.reload(); // Simple way to refresh all data
                    }
                }.bind(this)
            });
        });
    });
    </script>
    
    <style>			
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
    </style>
</body>
</html>
@endsection