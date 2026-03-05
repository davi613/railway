@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-page-subtitle { font-size:0.88rem; color:#64748B; margin:3px 0 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }
    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:9px 20px; border-radius:10px; font-size:0.88rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-primary { background:linear-gradient(135deg,#F97316,#FDBA74); color:#fff; box-shadow:0 4px 14px rgba(249,115,22,0.25); }
    .bph-btn-primary:hover { background:linear-gradient(135deg,#EA6C0A,#F97316); color:#fff; }
    .bph-btn-warning { background:#F97316; color:#fff; }
    .bph-btn-warning:hover { background:#EA6C0A; color:#fff; }
    .bph-btn-danger { background:#EF4444; color:#fff; }
    .bph-btn-danger:hover { background:#DC2626; color:#fff; }
    .bph-btn-sm { padding:5px 12px; font-size:0.78rem; border-radius:8px; }
    .bph-alert-success { background:#F0FDF4; border:1.5px solid #BBF7D0; color:#15803D; padding:12px 18px; border-radius:10px; margin:0 0 20px; display:flex; align-items:center; gap:9px; font-weight:600; font-size:0.9rem; }
    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.82rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-table thead th { padding:12px 10px; font-size:0.73rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.4px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:10px; color:#334155; vertical-align:middle; text-align:center; border:none; }
    .bph-bukti-thumb { width:56px; height:56px; object-fit:cover; border-radius:8px; border:2px solid #F97316; cursor:pointer; transition:transform 0.2s; }
    .bph-bukti-thumb:hover { transform:scale(1.1); }

    /* Bootstrap Modal Override for foto */
    .modal-content { border-radius:16px; border:none; }
    .modal-body { padding:24px; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Daftar Pengiriman Paket</h1>
        <p class="bph-page-subtitle">Muncul ketika status paket diubah oleh Karyawan menjadi "MENUNGGU KURIR"</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Pengiriman</span>
        </div>
    </div>
    <a href="{{ route('pengiriman.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Pengiriman
    </a>
</div>

@if(session('success'))
    <div class="bph-alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<div class="bph-card">
    <div class="bph-table-scroll">
        <table class="bph-table">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No Penjualan</th>
                    <th>No. Invoice</th>
                    <th>Tanggal Kirim</th>
                    <th>Tanggal Tiba</th>
                    <th>Status Pengiriman</th>
                    <th>Nama Kurir</th>
                    <th>Telpon Kurir</th>
                    <th>Bukti Foto</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengirimans as $pengiriman)
                <tr>
                    <td>
                        <div style="display:flex; gap:4px; justify-content:center;">
                            <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form id="delete-form-{{ $pengiriman->id }}" action="{{ route('pengiriman.destroy', $pengiriman->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="bph-btn bph-btn-danger bph-btn-sm" onclick="bphConfirmDelete({{ $pengiriman->id }})">
                                    <i class="bi bi-trash3"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                    <td style="font-weight:700;">{{ $pengiriman->penjualan->id }}</td>
                    <td>{{ $pengiriman->no_invoice }}</td>
                    <td style="font-size:0.78rem;">{{ \Carbon\Carbon::parse($pengiriman->tgl_kirim)->format('d-m-Y H:i') }}</td>
                    <td style="font-size:0.78rem;">{{ $pengiriman->tgl_tiba ? \Carbon\Carbon::parse($pengiriman->tgl_tiba)->format('d-m-Y') : '<span style="color:#94A3B8;">Belum Tiba</span>' }}</td>
                    <td>
                        <span style="background:#FFF7ED; color:#F97316; font-weight:700; padding:3px 10px; border-radius:20px; font-size:0.75rem;">
                            {{ $pengiriman->status_kirim }}
                        </span>
                    </td>
                    <td>{{ $pengiriman->nama_kurir }}</td>
                    <td>{{ $pengiriman->telpon_kurir }}</td>
                    <td>
                        @if($pengiriman->bukti_foto)
                            <img src="{{ asset('storage/' . $pengiriman->bukti_foto) }}" alt="Bukti Foto" class="bph-bukti-thumb"
                                onclick="bphTampilkanFoto('{{ asset('storage/' . $pengiriman->bukti_foto) }}')">
                        @else
                            <span style="color:#CBD5E1; font-size:0.78rem;">Tidak ada</span>
                        @endif
                    </td>
                    <td>{{ $pengiriman->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Preview Foto (Bootstrap) -->
<div class="modal fade" id="bphFotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="bphPreviewFoto" src="" class="img-fluid rounded" style="max-height:400px;">
            </div>
            <div class="modal-footer" style="border-top:none;">
                <button type="button" class="bph-btn" style="background:#1A1A2E; color:#F97316;" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function bphTampilkanFoto(src) {
        document.getElementById('bphPreviewFoto').src = src;
        new bootstrap.Modal(document.getElementById('bphFotoModal')).show();
    }
    function bphConfirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#F97316',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) document.getElementById('delete-form-' + id).submit();
        });
    }
</script>
@endsection
