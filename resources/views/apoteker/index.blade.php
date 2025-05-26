@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection


@section('content')
<style>
    .welcome-box {
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        padding: 30px;
        border-radius: 15px;
        color: #2c3e50;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        text-align: center;
        margin-bottom: 40px;
    }

    .welcome-box h2 {
        font-size: 32px;
        font-weight: 700;
    }

    .welcome-box p {
        font-size: 18px;
        margin-top: 10px;
    }

    .card-feature {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        text-align: center;
        transition: all 0.3s ease;
    }

    .card-feature:hover {
        transform: translateY(-5px);
    }

    .card-feature i {
        font-size: 36px;
        color: #3498db;
        margin-bottom: 15px;
    }

    .card-feature h5 {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
    }

    .card-feature p {
        color: #7f8c8d;
        font-size: 14px;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container-fluid pt-4 px-4">
    <div class="welcome-box fade-in">
        <h2>Selamat Datang, Apoteker</h2>
        <p>"Meracik ketelitian, menyembuhkan dengan dedikasi."</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 fade-in">
            <div class="card-feature">
                <i class="fas fa-pills"></i>
                <h5>Manajemen Obat</h5>
                <p>Kelola data obat dengan mudah dan aman.</p>
            </div>
        </div>
        <div class="col-md-4 fade-in">
            <div class="card-feature">
                <i class="fas fa-notes-medical"></i>
                <h5>Keakuratan Resep</h5>
                <p>Pastikan setiap obat sesuai dengan resep dokter.</p>
            </div>
        </div>
        <div class="col-md-4 fade-in">
            <div class="card-feature">
                <i class="fas fa-user-shield"></i>
                <h5>Profesionalisme</h5>
                <p>Jaga kepercayaan dengan pelayanan yang optimal.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fadeInElements = document.querySelectorAll('.fade-in');
        fadeInElements.forEach((el, index) => {
            el.style.animationDelay = `${index * 0.2}s`;
        });
    });
</script>
@endsection
