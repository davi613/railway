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
        background: linear-gradient(135deg, #f6d365, #fda085);
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
        margin-bottom: 10px;
    }

    .welcome-box p {
        font-size: 18px;
    }

    .card-feature {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        text-align: center;
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .card-feature:hover {
        transform: translateY(-5px);
    }

    .card-feature i {
        font-size: 36px;
        color: #e67e22;
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
        <h2>Selamat Datang, Karyawan</h2>
        <p>"Bersama kita capai keberhasilan dengan kolaborasi dan dedikasi."</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4 fade-in">
            <div class="card-feature">
                <i class="fas fa-tasks"></i>
                <h5>Tugas Harian</h5>
                <p>Kelola dan laksanakan tugas harian secara efisien.</p>
            </div>
        </div>
        <div class="col-md-4 fade-in">
            <div class="card-feature">
                <i class="fas fa-comments"></i>
                <h5>Kolaborasi Tim</h5>
                <p>Bina komunikasi yang efektif dan sinergis antar rekan kerja.</p>
            </div>
        </div>
        <div class="col-md-4 fade-in">
            <div class="card-feature">
                <i class="fas fa-comments"></i>
                <h5>Kinerja Terukur</h5>
                <p>Analisa kinerja dan raih target dengan strategi terbaik.</p>
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
