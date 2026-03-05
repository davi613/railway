@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-page-subtitle { font-size:0.9rem; color:#64748B; margin:0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }
    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 20px; border-radius:10px; font-size:0.88rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-primary { background:linear-gradient(135deg,#F97316,#FDBA74); color:#fff; box-shadow:0 4px 14px rgba(249,115,22,0.25); }
    .bph-btn-primary:hover { background:linear-gradient(135deg,#EA6C0A,#F97316); color:#fff; }
    .bph-btn-danger { background:#EF4444; color:#fff; }
    .bph-btn-danger:hover { background:#DC2626; color:#fff; }
    .bph-btn-warning { background:#F97316; color:#fff; }
    .bph-btn-warning:hover { background:#EA6C0A; color:#fff; }
    .bph-btn-sm { padding:6px 13px; font-size:0.8rem; border-radius:8px; }
    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-card-head { display:flex; align-items:center; justify-content:space-between; padding:20px 28px; border-bottom:1.5px solid #F1F5F9; flex-wrap:wrap; gap:12px; }
    .bph-card-title { font-size:1.05rem; font-weight:700; color:#1A1A2E; display:flex; align-items:center; gap:9px; }
    .bph-card-title i { color:#F97316; }
    .bph-search { position:relative; display:flex; align-items:center; }
    .bph-search-icon { position:absolute; left:12px; color:#F97316; font-size:0.95rem; }
    .bph-search-input { padding:8px 14px 8px 36px; border-radius:10px; border:1.5px solid #E2E8F0; font-size:0.88rem; outline:none; transition:border 0.2s; min-width:220px; background:#FAFAFA; }
    .bph-search-input:focus { border-color:#F97316; background:#fff; }
    .bph-search-btn { margin-left:8px; padding:8px 16px; border-radius:10px; border:none; background:linear-gradient(135deg,#F97316,#FDBA74); color:#fff; font-weight:700; font-size:0.88rem; cursor:pointer; display:inline-flex; align-items:center; gap:5px; }
    .bph-search-btn:hover { background:linear-gradient(135deg,#EA6C0A,#F97316); }
    .bph-alert-success { background:#F0FDF4; border:1.5px solid #BBF7D0; color:#15803D; padding:12px 18px; border-radius:10px; margin:0 28px 20px; display:flex; align-items:center; gap:9px; font-weight:600; font-size:0.9rem; }
    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.875rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E 0%,#2D2D4E 100%); }
    .bph-table thead th { padding:13px 14px; font-size:0.78rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.5px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:12px 14px; color:#334155; vertical-align:middle; text-align:center; border:none; }
    .bph-pagination { display:flex; justify-content:center; gap:8px; padding:20px 28px; border-top:1.5px solid #F1F5F9; }
    .bph-page-btn { display:inline-flex; align-items:center; gap:5px; padding:8px 18px; border-radius:9px; font-size:0.85rem; font-weight:700; border:1.5px solid #F97316; color:#F97316; background:#fff; text-decoration:none; transition:all 0.2s; cursor:pointer; }
    .bph-page-btn:hover { background:#F97316; color:#fff; }
    .bph-page-btn.disabled { border-color:#E2E8F0; color:#CBD5E1; cursor:not-allowed; pointer-events:none; }
    .bph-empty { text-align:center; padding:40px; color:#94A3B8; }
    .bph-empty i { font-size:2.2rem; display:block; margin-bottom:10px; color:#F97316; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Data Pembelian</h1>
        <p class="bph-page-subtitle">Silahkan Tambahkan Data Pembelian Dari Distributor</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Pembelian</span>
        </div>
    </div>
    <a href="{{ route('pembelian.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Pembelian
    </a>
</div>

@if (session('success'))
    <div class="bph-alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title"><i class="bi bi-cart3"></i> Daftar Pembelian</div>
        <form method="GET" style="display:flex; align-items:center;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" name="search" class="bph-search-input" placeholder="Cari data pembelian..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="bph-search-btn"><i class="bi bi-search"></i> Cari</button>
        </form>
    </div>

    <div class="bph-table-scroll">
        <table class="bph-table">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No.</th>
                    <th>No Nota</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Bayar</th>
                    <th>Distributor</th>
                    <th>Dibuat Pada</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembelians as $no => $pembelian)
                <tr>
                    <td>
                        <div style="display:flex; gap:5px; justify-content:center;">
                            <a href="{{ route('pembelian.edit', $pembelian->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" class="d-inline form-hapus">
                                @csrf @method('DELETE')
                                <button type="submit" class="bph-btn bph-btn-danger bph-btn-sm">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                    <td><strong>{{ $no + $pembelians->firstItem() }}.</strong></td>
                    <td style="font-weight:700;">{{ $pembelian->nonota }}</td>
                    <td>{{ date('d-m-Y', strtotime($pembelian->tgl_pembelian)) }}</td>
                    <td style="font-weight:700; color:#F97316;">Rp {{ number_format($pembelian->total_bayar, 2, ',', '.') }}</td>
                    <td>{{ $pembelian->distributor->nama_distributor }}</td>
                    <td style="font-size:0.78rem; color:#94A3B8;">{{ $pembelian->created_at->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="bph-empty"><i class="bi bi-inbox"></i><p>Tidak ada data pembelian.</p></div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($pembelians->hasPages())
        <div class="bph-pagination">
            @if ($pembelians->onFirstPage())
                <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
            @else
                <a class="bph-page-btn" href="{{ $pembelians->previousPageUrl() }}"><i class="bi bi-chevron-left"></i> Prev</a>
            @endif
            @if ($pembelians->hasMorePages())
                <a class="bph-page-btn" href="{{ $pembelians->nextPageUrl() }}">Next <i class="bi bi-chevron-right"></i></a>
            @else
                <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
            @endif
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#F97316',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => { if (result.isConfirmed) form.submit(); });
        });
    });
</script>
@endsection
