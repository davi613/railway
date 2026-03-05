@extends('be.master')

@section('navbar')
@include('be.navbar')
@endsection

@section('sidebar')
@include('be.sidebar')
@endsection
@section('content')

<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-report-card-outer { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-report-card-head { padding:20px 28px; border-bottom:1.5px solid #F1F5F9; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; }
    .bph-report-card-title { font-size:1.05rem; font-weight:700; color:#1A1A2E; display:flex; align-items:center; gap:9px; }
    .bph-report-card-title i { color:#F97316; }
    .bph-report-card-body { padding:28px; }

    .bph-report-grid { display:flex; flex-wrap:wrap; gap:24px; }
    .bph-report-inner {
        background: #fff;
        border-radius: 16px;
        padding: 24px 28px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
        border: 1.5px solid #F1F5F9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex: 1 1 calc(50% - 24px);
        min-width: 280px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    @media (max-width:768px) { .bph-report-inner { flex: 1 1 100%; } }
    .bph-report-inner:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.12); }

    .bph-report-text { max-width: 70%; }
    .bph-report-label { font-size:0.75rem; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px; display:block; }
    .bph-report-value { font-size:1.85rem; font-weight:800; color:#1A1A2E; margin-bottom:8px; line-height:1.1; }
    .bph-report-value.text-danger { color:#EF4444; }
    .bph-report-value.text-success { color:#16A34A; }
    .bph-report-link { font-size:0.88rem; font-weight:700; color:#F97316; text-decoration:none; }
    .bph-report-link:hover { color:#EA6C0A; text-decoration:underline; }

    .bph-report-icon {
        width: 68px; height: 68px;
        border-radius: 50%;
        display: flex; justify-content: center; align-items: center;
        flex-shrink: 0;
        font-size: 1.8rem;
        box-shadow: 0 4px 14px rgba(0,0,0,0.1);
    }
    .bph-icon-penjualan { background: linear-gradient(135deg,#38b2ac,#319795); color:#e6fffa; }
    .bph-icon-kasir { background: linear-gradient(135deg,#F97316,#FDBA74); color:#fff; }
    .bph-icon-pembelian { background: linear-gradient(135deg,#EF4444,#DC2626); color:#fff; }
    .bph-icon-return { background: linear-gradient(135deg,#1A1A2E,#2D2D4E); color:#F97316; }

    .bph-reload-btn {
        display: inline-flex; align-items:center; gap:6px;
        padding: 8px 16px; border-radius:10px; border:1.5px solid #F97316;
        background: #fff; color:#F97316; font-weight:700; font-size:0.85rem;
        cursor:pointer; transition:all 0.2s;
    }
    .bph-reload-btn:hover { background:#F97316; color:#fff; }

    .bph-alert { padding:16px 20px; border-radius:12px; margin-top:24px; }
    .bph-alert-danger { background:#FEF2F2; border:1.5px solid #FECACA; color:#991B1B; }
    .bph-alert-success { background:#F0FDF4; border:1.5px solid #BBF7D0; color:#14532D; }
    .bph-alert h6 { font-weight:800; margin-bottom:10px; }
    .bph-alert ul { margin:0; padding-left:20px; }
    .bph-alert ul li { margin-bottom:4px; font-size:0.9rem; }

    #bphLoadingOverlay {
        display:none; position:fixed; z-index:9999;
        background:rgba(255,255,255,0.93); width:100%; height:100%;
        top:0; left:0; justify-content:center; align-items:center; flex-direction:column;
    }
    #bphLoadingText { font-size:1rem; font-weight:700; margin-top:16px; color:#F97316; }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.4/lottie.min.js"></script>

<div id="bphLoadingOverlay">
    <div id="bphLottie" style="width:160px; height:160px;"></div>
    <div id="bphLoadingText">Memuat ulang data...</div>
</div>

<script>
    var bphAnim = lottie.loadAnimation({
        container: document.getElementById('bphLottie'),
        renderer: 'svg', loop: true, autoplay: true,
        path: 'https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json'
    });
    function bphReload() {
        document.getElementById('bphLoadingOverlay').style.display = 'flex';
        setTimeout(() => location.reload(), 1000);
    }
</script>

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Ringkasan Laporan</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Laporan</span>
        </div>
    </div>
    <button class="bph-reload-btn" onclick="bphReload()">
        <i class="bi bi-arrow-clockwise"></i> Refresh
    </button>
</div>

<!-- Report Card -->
<div class="bph-report-card-outer">
    <div class="bph-report-card-head">
        <div class="bph-report-card-title">
            <i class="bi bi-bar-chart-line-fill"></i>
            Ringkasan Laporan Toko Online Apotek
        </div>
        <span style="font-size:0.82rem; color:#94A3B8; font-weight:600;">Updated Report</span>
    </div>
    <div class="bph-report-card-body">

        @php
            $return = ($totalExpense + $totalkasir) - $totalbeli;
            $returnClass = $return < 0 ? 'text-danger' : 'text-success';
        @endphp

        <div class="bph-report-grid">
            <div class="bph-report-inner">
                <div class="bph-report-text">
                    <span class="bph-report-label">Total Penjualan Di Online</span>
                    <div class="bph-report-value">Rp {{ number_format($totalExpense, 0, ',', '.') }}</div>
                    <a href="{{ route('laporan-jual.index') }}" class="bph-report-link"><i class="bi bi-arrow-right-circle"></i> Detail Penjualan</a>
                </div>
                <div class="bph-report-icon bph-icon-penjualan"><i class="bi bi-rocket-takeoff-fill"></i></div>
            </div>

            <div class="bph-report-inner">
                <div class="bph-report-text">
                    <span class="bph-report-label">Total Pendapatan Kasir</span>
                    <div class="bph-report-value">Rp {{ number_format($totalkasir, 0, ',', '.') }}</div>
                    <a href="{{ route('laporan_kasir.index') }}" class="bph-report-link"><i class="bi bi-arrow-right-circle"></i> Detail Penjualan Kasir</a>
                </div>
                <div class="bph-report-icon bph-icon-kasir"><i class="bi bi-cash-coin"></i></div>
            </div>

            <div class="bph-report-inner">
                <div class="bph-report-text">
                    <span class="bph-report-label">Total Pembelian</span>
                    <div class="bph-report-value">Rp {{ number_format($totalbeli, 0, ',', '.') }}</div>
                    <a href="{{ route('laporan-beli.index') }}" class="bph-report-link"><i class="bi bi-arrow-right-circle"></i> Detail Pembelian</a>
                </div>
                <div class="bph-report-icon bph-icon-pembelian"><i class="bi bi-briefcase-fill"></i></div>
            </div>

            <div class="bph-report-inner">
                <div class="bph-report-text">
                    <span class="bph-report-label">Return</span>
                    <div class="bph-report-value {{ $returnClass }}">Rp {{ number_format($return, 0, ',', '.') }}</div>
                </div>
                <div class="bph-report-icon bph-icon-return"><i class="bi bi-gem"></i></div>
            </div>
        </div>

        @if ($return < 0)
            <div class="bph-alert bph-alert-danger">
                <h6><i class="bi bi-exclamation-triangle-fill me-2"></i>Perhatian! Return Anda mengalami kerugian.</h6>
                <ul>
                    <li>Evaluasi harga jual atau diskon yang diberikan.</li>
                    <li>Optimalkan stok dan kontrol pembelian.</li>
                    <li>Tingkatkan strategi pemasaran produk unggulan.</li>
                </ul>
            </div>
        @else
            <div class="bph-alert bph-alert-success">
                <h6><i class="bi bi-check-circle-fill me-2"></i>Bagus! Return Anda positif.</h6>
                <ul>
                    <li>Pertahankan strategi penjualan yang ada.</li>
                    <li>Eksplorasi pengembangan cabang atau layanan baru.</li>
                    <li>Investasikan kembali untuk memperluas produk unggulan.</li>
                </ul>
            </div>
        @endif

    </div>
</div>
@endsection
