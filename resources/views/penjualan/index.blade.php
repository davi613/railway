@extends('be.master')

@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-page-subtitle { font-size:0.88rem; color:#64748B; margin:3px 0 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-btn { display:inline-flex; align-items:center; gap:7px; padding:8px 18px; border-radius:10px; font-size:0.85rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-warning { background:#F97316; color:#fff; }
    .bph-btn-warning:hover { background:#EA6C0A; color:#fff; }
    .bph-btn-danger { background:#EF4444; color:#fff; }
    .bph-btn-danger:hover { background:#DC2626; color:#fff; }
    .bph-btn-sm { padding:5px 12px; font-size:0.78rem; border-radius:8px; }

    .bph-filter-wrap { margin-bottom:20px; }
    .bph-filter-label { font-size:0.85rem; font-weight:700; color:#334155; margin-bottom:8px; display:block; }
    .bph-filter-group { display:flex; align-items:center; gap:0; }
    .bph-filter-prefix { padding:9px 14px; background:#1A1A2E; color:#F97316; border-radius:10px 0 0 10px; font-size:0.9rem; }
    .bph-filter-select { padding:9px 14px; border:1.5px solid #E2E8F0; border-left:none; border-radius:0 10px 10px 0; font-size:0.88rem; font-weight:600; color:#1A1A2E; background:#FAFAFA; outline:none; min-width:220px; }
    .bph-filter-select:focus { border-color:#F97316; }

    .bph-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; margin-bottom:28px; overflow:hidden; }
    .bph-table-scroll { overflow-x:auto; }
    .bph-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.82rem; }
    .bph-table thead tr { background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-table thead th { padding:12px 10px; font-size:0.73rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.4px; border:none; white-space:nowrap; text-align:center; }
    .bph-table tbody tr { border-bottom:1px solid #F1F5F9; transition:background 0.15s; }
    .bph-table tbody tr:hover { background:#FFF7ED; }
    .bph-table tbody td { padding:10px 10px; color:#334155; vertical-align:middle; text-align:center; border:none; }

    .bph-badge { padding:4px 12px; border-radius:20px; font-size:0.73rem; font-weight:700; white-space:nowrap; }
    .bph-badge-primary { background:#DBEAFE; color:#1D4ED8; }
    .bph-badge-success { background:#DCFCE7; color:#16A34A; }
    .bph-badge-danger { background:#FEE2E2; color:#DC2626; }
    .bph-badge-warning { background:#FEF3C7; color:#D97706; }
    .bph-badge-dark { background:#1A1A2E; color:#F97316; }
    .bph-badge-secondary { background:#F1F5F9; color:#64748B; }

    .bph-resep-thumb { width:56px; height:56px; object-fit:cover; border-radius:8px; border:2px solid #F97316; cursor:pointer; transition:transform 0.2s; }
    .bph-resep-thumb:hover { transform:scale(1.1); }

    .bph-modal-resep { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background:rgba(0,0,0,0.75); }
    .bph-modal-content-resep { background:#fff; margin:8% auto; padding:28px; border-radius:16px; max-width:560px; text-align:center; position:relative; }
    .bph-modal-content-resep img { max-width:100%; border-radius:10px; }
    .bph-modal-close { position:absolute; top:12px; right:18px; font-size:1.8rem; font-weight:700; color:#64748B; cursor:pointer; line-height:1; }

    .bph-alert-info { background:#EFF6FF; border:1.5px solid #BFDBFE; color:#1D4ED8; padding:16px 20px; border-radius:12px; text-align:center; font-weight:600; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Daftar Paket</h1>
        <p class="bph-page-subtitle">Paket muncul ketika status diubah oleh Kasir menjadi "DIPROSES"</p>
        <div class="bph-breadcrumb" style="margin-top:4px;">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Penjualan</span>
        </div>
    </div>
</div>

@php
    $statusYangDitampilkan = ['Diproses', 'Menunggu Kurir', 'Dibatalkan Penjual', 'Selesai'];
    $penjualansFiltered = $penjualans->whereIn('status_order', $statusYangDitampilkan);
@endphp

<!-- Filter -->
<div class="bph-filter-wrap">
    <label class="bph-filter-label"><i class="bi bi-funnel-fill me-1" style="color:#F97316;"></i> Filter Status Pesanan</label>
    <div class="bph-filter-group">
        <span class="bph-filter-prefix"><i class="bi bi-filter-circle"></i></span>
        <select id="bphFilterStatus" class="bph-filter-select" onchange="bphFilterTable()">
            <option value="">-- Semua Status --</option>
            @foreach($statusYangDitampilkan as $status)
                <option value="{{ $status }}">{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>

@if($penjualansFiltered->isEmpty())
    <div class="bph-alert-info"><i class="bi bi-info-circle me-2"></i>Tidak ada pesanan paket</div>
@else
<div class="bph-card">
    <div class="bph-table-scroll">
        <table class="bph-table" id="bphPenjualanTable">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No Penjualan</th>
                    <th>Metode Bayar</th>
                    <th>Tanggal</th>
                    <th>Resep</th>
                    <th>Ongkir</th>
                    <th>Biaya App</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Jenis Kirim</th>
                    <th>Pelanggan</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualansFiltered as $penjualan)
                    <tr data-status="{{ $penjualan->status_order }}">
                        <td>
                            <div style="display:flex; gap:4px; justify-content:center; flex-wrap:wrap;">
                                @if($penjualan->status_order != 'Selesai')
                                    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                @endif
                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline bph-form-delete">
                                    @csrf @method('DELETE')
                                    <button type="button" class="bph-btn bph-btn-danger bph-btn-sm bph-btn-delete"><i class="bi bi-trash3"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                        <td style="font-weight:700;">{{ $penjualan->id }}</td>
                        <td>{{ $penjualan->id_metode_bayar }}</td>
                        <td style="font-size:0.78rem;">{{ $penjualan->tgl_penjualan }}</td>
                        <td>
                            @if($penjualan->url_resep)
                                <img src="{{ $penjualan->url_resep }}" alt="Resep" class="bph-resep-thumb" onclick="bphShowModal('{{ $penjualan->url_resep }}')">
                            @else <span style="color:#CBD5E1;">-</span> @endif
                        </td>
                        <td>Rp {{ number_format($penjualan->ongkos_kirim, 2, ',', '.') }}</td>
                        <td>Rp {{ number_format($penjualan->biaya_app, 2, ',', '.') }}</td>
                        <td style="font-weight:700; color:#F97316;">Rp {{ number_format($penjualan->total_bayar, 2, ',', '.') }}</td>
                        <td>
                            <span class="bph-badge
                                @if($penjualan->status_order=='Diproses') bph-badge-primary
                                @elseif($penjualan->status_order=='Selesai') bph-badge-success
                                @elseif($penjualan->status_order=='Dibatalkan Penjual') bph-badge-danger
                                @elseif($penjualan->status_order=='Menunggu Kurir') bph-badge-warning
                                @elseif($penjualan->status_order=='Bermasalah') bph-badge-dark
                                @else bph-badge-secondary @endif">
                                {{ $penjualan->status_order }}
                            </span>
                        </td>
                        <td>{{ $penjualan->keterangan_status ?? '-' }}</td>
                        <td>{{ $penjualan->jenisPengiriman->jenis_kirim ?? '-' }}</td>
                        <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                        <td style="font-size:0.72rem; color:#94A3B8;">{{ $penjualan->created_at }}</td>
                        <td style="font-size:0.72rem; color:#94A3B8;">{{ $penjualan->updated_at }}</td>
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
    function bphShowModal(url) {
        document.getElementById('bphResepImage').src = url;
        document.getElementById('bphModalResep').style.display = 'block';
    }
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

    function bphFilterTable() {
        const sel = document.getElementById('bphFilterStatus').value.toLowerCase();
        document.querySelectorAll('#bphPenjualanTable tbody tr').forEach(row => {
            const st = row.getAttribute('data-status').toLowerCase();
            row.style.display = (!sel || st === sel) ? '' : 'none';
        });
    }
</script>
@endsection
