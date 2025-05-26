@extends('be.master')

@section('navbar')
@include('be.navbar')
@endsection

@section('sidebar')
@include('be.sidebar')
@endsection
@section('content')

<style>
    #loadingOverlay {
        display: none;
        position: fixed;
        z-index: 9999;
        background: rgba(255, 255, 255, 0.9);
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    #loadingOverlay img {
        width: 120px;
        height: 120px;
    }

    #loadingText {
        font-size: 18px;
        font-weight: bold;
        margin-top: 15px;
        color: #555;
    }

    /* ===== CARD WRAPPER GRID ===== */
    .report-inner-cards-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        justify-content: space-between;
        margin-top: 1rem;
    }

    /* ===== SINGLE CARD ===== */
    .report-inner-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px 32px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex: 1 1 calc(50% - 24px); /* 2 cards per row, with gap */
        min-width: 300px;
        cursor: default;
    }

    @media (max-width: 768px) {
        .report-inner-card {
            flex: 1 1 100%; /* full width on smaller screens */
        }
    }

    .report-inner-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }

    /* ===== TEXT AREA ===== */
    .inner-card-text {
        max-width: 70%;
    }

    .report-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1.1px;
    }

    .inner-card-text h4 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: #212529;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .inner-card-text a.report-count {
        font-size: 0.95rem;
        color: #007bff;
        font-weight: 600;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .inner-card-text a.report-count:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    /* ===== ICON AREA ===== */
    .inner-card-icon {
        font-size: 2.8rem;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: box-shadow 0.3s ease;
    }
    .report-inner-card:hover .inner-card-icon {
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }

    /* ===== ICON COLORS & BACKGROUNDS - UNIQUE PER CARD ===== */
    /* Total Penjualan Online */
    .icon-penjualan {
        background: linear-gradient(135deg, #38b2ac, #319795); /* teal gradient */
        color: #e6fffa;
    }

    /* Total Pendapatan Kasir */
    .icon-kasir {
        background: linear-gradient(135deg, #f6ad55, #dd6b20); /* orange gradient */
        color: #fff7ed;
    }

    /* Total Pembelian */
    .icon-pembelian {
        background: linear-gradient(135deg, #f56565, #c53030); /* red gradient */
        color: #fff5f5;
    }

    /* RETURN */
    .icon-return {
        background: linear-gradient(135deg, #4299e1, #2b6cb0); /* blue gradient */
        color: #ebf8ff;
    }

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.4/lottie.min.js"></script>

<div id="loadingOverlay">
    <div id="lottieAnimation" style="width: 200px; height: 200px;"></div>
    <div id="loadingText">Memuat ulang data...</div>
</div>

<button class="btn btn-icons border-0 p-2" onclick="showLoadingAndReload();">
    <i class="icon-refresh"></i>
</button>

<script>
    var animation = lottie.loadAnimation({
        container: document.getElementById('lottieAnimation'),
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: 'https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json'
    });

    function showLoadingAndReload() {
        const loading = document.getElementById('loadingOverlay');
        loading.style.display = 'flex';
        setTimeout(() => {
            location.reload();
        }, 1000);
    }
</script>




<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="d-sm-flex align-items-baseline report-summary-header">
                            <h5 class="font-weight-semibold">Ringkasan Laporan Toko Online Apotek</h5>
                            <span class="ms-auto">Updated Report</span>
                            <button class="btn btn-icons border-0 p-2" onclick="showLoadingAndReload();">
                                <i class="icon-refresh"></i>
                            </button>
                        </div>
                    </div>
                </div>

                @php
                    $return = ($totalExpense + $totalkasir) - $totalbeli;
                    $returnClass = $return < 0 ? 'text-danger' : 'text-success';
                @endphp

                <div class="report-inner-cards-wrapper">

                    <div class="report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">Total Penjualan Di Online</span>
                            <h4>Rp {{ number_format($totalExpense, 0, ',', '.') }}</h4>
                            <a href="{{ route('laporan-jual.index') }}" class="report-count">Detail Penjualan</a>
                        </div>
                        <div class="inner-card-icon icon-penjualan">
                            <i class="icon-rocket"></i>
                        </div>
                    </div>

                    <div class="report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">Total Pendapatan Kasir</span>
                            <h4>Rp {{ number_format($totalkasir, 0, ',', '.') }}</h4>
                            <a href="{{ route('laporan_kasir.index') }}" class="report-count">Detail Penjualan Kasir</a>
                        </div>
                        <div class="inner-card-icon icon-kasir">
                            <i class="icon-wallet"></i>
                        </div>
                    </div>

                    <div class="report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">Total Pembelian</span>
                            <h4>Rp {{ number_format($totalbeli, 0, ',', '.') }}</h4>
                            <a href="{{ route('laporan-beli.index') }}" class="report-count">Detail Pembelian</a>
                        </div>
                        <div class="inner-card-icon icon-pembelian">
                            <i class="icon-briefcase"></i>
                        </div>
                    </div>

                    <div class="report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">RETURN</span>
                            <h4 class="{{ $returnClass }}">
                                Rp {{ number_format($return, 0, ',', '.') }}
                            </h4>
                        </div>
                        <div class="inner-card-icon icon-return">
                            <i class="icon-diamond"></i>
                        </div>
                    </div>

                </div>

                {{-- Saran Berdasarkan Return --}}
                @if ($return < 0)
                    <div class="alert alert-danger mt-4" role="alert">
                        <h6><strong>Perhatian!</strong> Return Anda mengalami kerugian.</h6>
                        <ul class="mb-0">
                            <li>Evaluasi harga jual atau diskon yang diberikan.</li>
                            <li>Optimalkan stok dan kontrol pembelian.</li>
                            <li>Tingkatkan strategi pemasaran produk unggulan.</li>
                        </ul>
                    </div>
                @else
                    <div class="alert alert-success mt-4" role="alert">
                        <h6><strong>Bagus!</strong> Return Anda positif.</h6>
                        <ul class="mb-0">
                            <li>Pertahankan strategi penjualan yang ada.</li>
                            <li>Eksplorasi pengembangan cabang atau layanan baru.</li>
                            <li>Investasikan kembali untuk memperluas produk unggulan.</li>
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
