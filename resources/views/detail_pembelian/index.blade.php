@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
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
    .bph-alert-success { background:#F0FDF4; border:1.5px solid #BBF7D0; color:#15803D; padding:12px 18px; border-radius:10px; margin:0 0 20px; display:flex; align-items:center; gap:9px; font-weight:600; font-size:0.9rem; }
    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-card-head { display:flex; align-items:center; justify-content:space-between; padding:20px 28px; border-bottom:1.5px solid #F1F5F9; flex-wrap:wrap; gap:12px; }
    .bph-card-title { font-size:1.05rem; font-weight:700; color:#1A1A2E; display:flex; align-items:center; gap:9px; }
    .bph-card-title i { color:#F97316; }
    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.875rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E 0%,#2D2D4E 100%); }
    .bph-table thead th { padding:13px 14px; font-size:0.78rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.5px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:12px 14px; color:#334155; vertical-align:middle; text-align:center; border:none; }
    .bph-empty { text-align:center; padding:40px; color:#94A3B8; }
    .bph-empty i { font-size:2.2rem; display:block; margin-bottom:10px; color:#F97316; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Detail Pembelian Obat</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('pembelian.index') }}">Pembelian</a>
            <span class="sep">/</span>
            <span>Detail</span>
        </div>
    </div>
    <a href="{{ route('detail_pembelian.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Detail
    </a>
</div>

@if (session('success'))
    <div class="bph-alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title"><i class="bi bi-list-ul"></i> Detail Data Pembelian Obat</div>
    </div>

    <div class="bph-table-scroll">
        <table class="bph-table">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No.</th>
                    <th>No Nota</th>
                    <th>Nama Obat</th>
                    <th>Jumlah Beli</th>
                    <th>Harga Beli</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $no => $detail)
                <tr>
                    <td>
                        <div style="display:flex; gap:5px; justify-content:center;">
                            <a href="{{ route('detail_pembelian.edit', $detail->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('detail_pembelian.destroy', $detail->id) }}" method="POST" class="d-inline form-hapus">
                                @csrf @method('DELETE')
                                <button type="submit" class="bph-btn bph-btn-danger bph-btn-sm">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                    <td><strong>{{ $no + 1 }}.</strong></td>
                    <td style="font-weight:700;">{{ $detail->pembelian->nonota }}</td>
                    <td style="font-weight:700; text-align:left;">{{ $detail->obat->nama_obat }}</td>
                    <td>{{ $detail->jumlah_beli }}</td>
                    <td style="color:#F97316; font-weight:700;">Rp {{ number_format($detail->harga_beli, 2, ',', '.') }}</td>
                    <td style="color:#16A34A; font-weight:700;">Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
