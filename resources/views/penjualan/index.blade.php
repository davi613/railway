@extends('be.master')

@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .modal-resep {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.7);
    }

    .modal-content-resep {
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        max-width: 600px;
        text-align: center;
        position: relative;
    }

    .modal-content-resep img {
        max-width: 100%;
        border-radius: 8px;
    }

    .close-resep {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        cursor: pointer;
    }

    label, .form-select, .input-group-text {
        font-size: 1rem;
    }

    .form-select {
        border-radius: 0.5rem;
        background-color: #f8f9fa;
        transition: 0.3s ease;
    }

    .form-select:focus {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        border-color: #0d6efd;
    }

    .input-group-text {
        border-top-left-radius: 0.5rem;
        border-bottom-left-radius: 0.5rem;
        font-weight: 600;
    }

    table, th, td {
        color: #212529 !important;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5em 0.75em;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4">DAFTAR PAKET</h2>
    <h5 class="mb-4">Daftar paket akan muncul ketika status paket diubah oleh "KASIR" menjadi "DIPROSES"</h5>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    @php
        $statusYangDitampilkan = ['Diproses', 'Menunggu Kurir', 'Dibatalkan Penjual', 'Selesai'];
        $penjualansFiltered = $penjualans->whereIn('status_order', $statusYangDitampilkan);
    @endphp

    <!-- Filter Status -->
    <div class="mb-4">
        <label for="filterStatus" class="form-label fw-semibold text-dark">Filter Status Pesanan</label>
        <div class="input-group">
            <span class="input-group-text bg-primary text-white">
                <i class="bi bi-filter-circle"></i>
            </span>
            <select id="filterStatus" class="form-select border-primary text-dark fw-semibold" onchange="filterTable()" style="max-width: 300px;">
                <option value="">-- Semua Status --</option>
                @foreach($statusYangDitampilkan as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($penjualansFiltered->isEmpty())
        <div class="alert alert-info text-center">
            Tidak ada pesanan paket
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm align-middle" id="penjualanTable">
                <thead class="table-light">
                    <tr class="text-center">
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
                            <td class="text-center">
                                @if($penjualan->status_order != 'Selesai')
                                    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                @endif

                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                                </form>
                            </td>
                            <td>{{ $penjualan->id }}</td>
                            <td>{{ $penjualan->id_metode_bayar }}</td>
                            <td>{{ $penjualan->tgl_penjualan }}</td>
                            <td class="text-center">
                                @if($penjualan->url_resep)
                                    <img src="{{ $penjualan->url_resep }}" alt="Resep" width="80" height="80"
                                        style="object-fit: cover; border-radius: 6px; cursor: pointer;"
                                        onclick="showModal('{{ $penjualan->url_resep }}')">
                                @else
                                    -
                                @endif
                            </td>
                            <td>Rp {{ number_format($penjualan->ongkos_kirim, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($penjualan->biaya_app, 2, ',', '.') }}</td>
                            <td>Rp {{ number_format($penjualan->total_bayar, 2, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    @if($penjualan->status_order == 'Diproses') 
                                        bg-primary 
                                    @elseif($penjualan->status_order == 'Selesai') 
                                        bg-success 
                                    @elseif($penjualan->status_order == 'Dibatalkan Penjual') 
                                        bg-danger 
                                    @elseif($penjualan->status_order == 'Menunggu Kurir') 
                                        bg-warning 
                                    @elseif($penjualan->status_order == 'Bermasalah') 
                                        bg-dark 
                                    @else 
                                        bg-secondary 
                                    @endif
                                    p-2 text-white rounded-pill"
                                    style="cursor: pointer;" 
                                    data-bs-toggle="tooltip" 
                                    title="Status: {{ $penjualan->status_order }}">
                                    {{ $penjualan->status_order }}
                                </span>
                            </td>
                            <td>{{ $penjualan->keterangan_status ?? '-' }}</td>
                            <td>{{ $penjualan->jenisPengiriman->jenis_kirim ?? '-' }}</td>
                            <td>{{ $penjualan->pelanggan->nama_pelanggan ?? '-' }}</td>
                            <td>{{ $penjualan->created_at }}</td>
                            <td>{{ $penjualan->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Modal -->
<div id="modalResep" class="modal-resep">
    <div class="modal-content-resep">
        <span class="close-resep" onclick="closeModal()">&times;</span>
        <img id="resepImage" src="" alt="Resep Dokter">
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showModal(imageUrl) {
        document.getElementById('resepImage').src = imageUrl;
        document.getElementById('modalResep').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('modalResep').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('modalResep');
        if (event.target === modal) {
            closeModal();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });

    function filterTable() {
        const selectedStatus = document.getElementById('filterStatus').value.toLowerCase();
        const rows = document.querySelectorAll('#penjualanTable tbody tr');

        rows.forEach(row => {
            const status = row.getAttribute('data-status').toLowerCase();
            if (!selectedStatus || status === selectedStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
