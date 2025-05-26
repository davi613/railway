@extends('fe.master')

@section('content')
 <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center mb-3">
                <div class="col-md-9 ftco-animate text-center">
                    <h1 class="mb-0 bread">Profile Saya</h1>
                </div>
            </div>
        </div>
    </div>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    @if($pelanggan->foto)
                        <img src="{{ asset('storage/'.$pelanggan->foto) }}" alt="Foto Profil" 
                             class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->nama_pelanggan) }}&background=random" 
                             class="rounded-circle img-fluid" style="width: 150px;">
                    @endif
                    <h5 class="my-3">{{ $pelanggan->nama_pelanggan }}</h5>
                    <p class="text-muted mb-1">{{ $pelanggan->email }}</p>
                    <p class="text-muted mb-4">{{ $pelanggan->no_telp }}</p>
                    <div class="d-flex justify-content-center mb-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">EDIT PROFILE ATAU UBAH DATA KAMU</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            {{-- Informasi Pribadi --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>DATA DIRI</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nama Lengkap</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $pelanggan->nama_pelanggan }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $pelanggan->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">No. Telepon</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $pelanggan->no_telp }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Alamat Utama --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5>ALAMAT UTAMA </h5>
                </div>
                <div class="card-body">
                    <p>{{ $pelanggan->alamat1 }}</p>
                    <p>{{ $pelanggan->kota1 }}, {{ $pelanggan->provinsi1 }} {{ $pelanggan->kodepos1 }}</p>
                </div>
            </div>

            {{-- Alamat Alternatif 1 --}}
<div class="card mb-4">
    <div class="card-header">
        <h5>ALAMAT ALTERNATIF 2</h5>
    </div>
    <div class="card-body">
        @if(empty($pelanggan->alamat2))
            <p class="text-muted">Alamat Alternatif Belum Anda Tambahkan</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary mt-2">Tambah Alamat</a>
        @else
            <p>{{ $pelanggan->alamat2 }}</p>
            <p>{{ $pelanggan->kota2 }}, {{ $pelanggan->provinsi2 }} {{ $pelanggan->kodepos2 }}</p>
        @endif
    </div>
</div>

{{-- Alamat Alternatif 2 --}}
<div class="card mb-4">
    <div class="card-header">
        <h5>ALAMAT ALTERNATIF 3</h5>
    </div>
    <div class="card-body">
        @if(empty($pelanggan->alamat3))
            <p class="text-muted">Alamat Alternatif Belum Anda Tambahkan</p>
            <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary mt-2">Tambah Alamat</a>
        @else
            <p>{{ $pelanggan->alamat3 }}</p>
            <p>{{ $pelanggan->kota3 }}, {{ $pelanggan->provinsi3 }} {{ $pelanggan->kodepos3 }}</p>
        @endif
    </div>
</div>

        </div>
    </div>
</div>
@endsection
