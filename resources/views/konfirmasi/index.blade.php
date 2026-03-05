@extends('be.master')

@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-page-subtitle { font-size:0.88rem; color:#64748B; margin:3px 0 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-btn { display:inline-flex; align-items:center; gap:6px; padding:7px 15px; border-radius:9px; font-size:0.81rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-warning { background:#F97316; color:#fff; }
    .bph-btn-warning:hover { background:#EA6C0A; color:#fff; }
    .bph-btn-danger { background:#EF4444; color:#fff; }
    .bph-btn-danger:hover { background:#DC2626; color:#fff; }
    .bph-btn-info { background:#0EA5E9; color:#fff; }
    .bph-btn-info:hover { background:#0284C7; color:#fff; }
    .bph-btn-sm { padding:5px 12px; font-size:0.78rem; border-radius:8px; }

    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.82rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-table thead th { padding:12px 10px; font-size:0.73rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.4px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:10px; color:#334155; vertical-align:middle; text-align:center; border:none; }

    .bph-badge-menunggu { background:#FEF3C7; color:#D97706; padding:4px 12px; border-radius:20px; font-size:0.73rem; font-weight:700; white-space:nowrap; }
    .bph-badge-dibatalkan { background:#FEE2E2; color:#DC2626; padding:4px 12px; border-radius:20px; font-size:0.73rem; font-weight:700; white-space:nowrap; }
    .bph-badge-default { background:#F1F5F9; color:#64748B; padding:4px 12px; border-radius:20px; font-size:0.73rem; font-weight:700; white-space:nowrap; }

    .bph-resep-thumb { width:56px; height:56px; object-fit:cover; border-radius:8px; border:2px solid #F97316; cursor:pointer; transition:transform 0.2s; }
    .bph-resep-thumb:hover { transform:scale(1.1); }

    .bph-modal-resep { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.75); }
    .bph-modal-content-resep { background:#fff; margin:8% auto; padding:28px; border-radius:16px; max-width:560px; text-align:center; position:relative; }
    .bph-modal-content-resep img { max-width:100%; border-radius:10px; }
    .bph-modal-close { position:absolute; top:12px; right:18px; font-size:1.8rem; font-weight:700; color:#64748B; cursor:pointer; line-height:1; }

    .bph-alert-info { background:#EFF6FF; border:1.5px solid #BFDBFE; color:#1D4ED8; padding:16px 20px; border-radius:12px; text-align:center; font-weight:600; margin-bottom:20px; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Konfirmasi Paket</h1>
        <p class="bph-page-subtitle">Hanya paket dengan status "MENUNGGU KONFIRMASI" yang bisa di edit</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Konfirmasi</span>
        </div>
    </div>
</div>

@php
    $konfirmasis = $konfirmasis->sortByDesc(function($item) {
        $priority = $item->status_order === 'Menunggu Konfirmasi' ? 2 : ($item->status_order === 'Dibatalkan Pembeli' ? 1 : 0);
        return $priority * 10000000000 + strtotime($item->updated_at);
    });
@endphp

@if($konfirmasis->isEmpty())
    <div class="bph-alert-info"><i class="bi bi-info-circle me-2"></i>Tidak ada pesanan yang perlu dikonfirmasi.</div>
@else
<div class="bph-card">
    <div class="bph-table-scroll">
        <table class="bph-table">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Foto Resep</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($konfirmasis as $konfirmasi)
                <tr>
                    <td>
                        <div style="display:flex; gap:4px; justify-content:center; flex-wrap:wrap;">
                            @if($konfirmasi->status_order == 'Menunggu Konfirmasi')
                                <a href="{{ route('konfirmasi.edit', $konfirmasi->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                            @endif
                            <a href="{{ route('konfirmasi.show', $konfirmasi->id) }}" class="bph-btn bph-btn-info bph-btn-sm">
                                <i class="bi bi-eye-fill"></i> Detail
                            </a>
                            <form action="{{ route('konfirmasi.destroy', $konfirmasi->id) }}" method="POST" class="d-inline bph-form-delete">
                                @csrf @method('DELETE')
                                <button type="button" class="bph-btn bph-btn-danger bph-btn-sm bph-btn-delete"><i class="bi bi-trash3"></i> Hapus</button>
                            </form>
                        </div>
                    </td>
                    <td style="font-weight:700;">{{ $konfirmasi->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td style="font-size:0.78rem;">{{ $konfirmasi->tgl_penjualan }}</td>
                    <td>
                        @if($konfirmasi->url_resep)
                            <img src="{{ $konfirmasi->url_resep }}" alt="Resep" class="bph-resep-thumb" onclick="bphShowModal('{{ $konfirmasi->url_resep }}')">
                        @else
                            <span style="color:#CBD5E1;">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="
                            @if($konfirmasi->status_order == 'Menunggu Konfirmasi') bph-badge-menunggu
                            @elseif($konfirmasi->status_order == 'Dibatalkan Pembeli') bph-badge-dibatalkan
                            @else bph-badge-default @endif">
                            {{ $konfirmasi->status_order }}
                        </span>
                    </td>
                    <td>{{ $konfirmasi->keterangan_status ?? '-' }}</td>
                    <td style="font-size:0.72rem; color:#94A3B8;">{{ $konfirmasi->created_at }}</td>
                    <td style="font-size:0.72rem; color:#94A3B8;">{{ $konfirmasi->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Modal Resep -->
<div id="bphModalResep" class="bph-modal-resep">
    <div class="bph-modal-content-resep">
        <span class="bph-modal-close" onclick="bphCloseModal()">&times;</span>
        <img id="bphResepImage" src="" alt="Resep Dokter">
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function bphShowModal(url) { document.getElementById('bphResepImage').src = url; document.getElementById('bphModalResep').style.display = 'block'; }
    function bphCloseModal() { document.getElementById('bphModalResep').style.display = 'none'; }
    window.addEventListener('click', function(e) { if (e.target === document.getElementById('bphModalResep')) bphCloseModal(); });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.bph-btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#F97316',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => { if (result.isConfirmed) form.submit(); });
            });
        });
    });
</script>
@endsection
