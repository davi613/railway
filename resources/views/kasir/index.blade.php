@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<style>
    .dashboard-kasir {
        padding: 30px;
    }

    .greeting-box {
        background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        color: #2c3e50;
        margin-bottom: 40px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }

    .greeting-box h2 {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .greeting-box p {
        font-size: 16px;
    }

    .kasir-cards {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .kasir-card {
        flex: 1 1 250px;
        background: #fff;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .kasir-card:hover {
        transform: translateY(-5px);
    }

    .kasir-card i {
        font-size: 40px;
        color: #3498db;
        margin-bottom: 15px;
    }

    .kasir-card h5 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #2c3e50;
    }

    .kasir-card p {
        font-size: 14px;
        color: #7f8c8d;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }
</style>

<div class="dashboard-kasir">
    <div class="greeting-box fade-in">
        <h2>Selamat Datang, Kasir</h2>
        <p>“Ketelitian dan kecepatan Anda adalah kunci dalam melayani pelanggan dengan baik.”</p>
    </div>

    <div class="kasir-cards">
        <div class="kasir-card fade-in" style="animation-delay: 0.1s">
            <i class="fas fa-cash-register"></i>
            <h5>Transaksi Cepat</h5>
            <p>Layani pembelian dengan sistem yang efisien dan user-friendly.</p>
        </div>
        <div class="kasir-card fade-in" style="animation-delay: 0.3s">
            <i class="fas fa-receipt"></i>
            <h5>Pencatatan Rapi</h5>
            <p>Pastikan setiap transaksi tercatat dengan akurat dan aman.</p>
        </div>
        <div class="kasir-card fade-in" style="animation-delay: 0.5s">
            <i class="fas fa-user-friends"></i>
            <h5>Pelayanan Prima</h5>
            <p>Berikan pengalaman terbaik untuk setiap pelanggan yang datang.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.fade-in').forEach((el, i) => {
            el.style.animationDelay = `${i * 0.2}s`;
        });
    });
</script>
@endsection
