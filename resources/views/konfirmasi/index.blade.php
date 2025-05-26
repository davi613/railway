@extends('be.master')

@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
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

    .badge-status-menunggu-konfirmasi {
        background-color: #FF6347;
        color: white;
    }

    .badge-status-dibatalkan-pembeli {
        background-color: #FF4500;
        color: white;
    }

    .badge-status-default {
        background-color: #808080;
        color: white;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4">Konfirmasi Paket</h2>
    <h5 class="mb-4">Hanya Paket Dengan status "MENUNGGU KONFIRMASI" yang bisa di edit</h5>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        </script>
    @endif

    <div class="table-responsive">
        @php
            $konfirmasis = $konfirmasis->sortByDesc(function($item) {
                $priority = $item->status_order === 'Menunggu Konfirmasi' ? 2
                          : ($item->status_order === 'Dibatalkan Pembeli' ? 1 : 0);
                return $priority * 10000000000 + strtotime($item->updated_at);
            });
        @endphp

        @if($konfirmasis->isEmpty())
            <div class="alert alert-info text-center">
                Tidak ada pesanan yang perlu dikonfirmasi.
            </div>
        @else
        <table class="table table-bordered table-hover table-sm align-middle">
            <thead class="table-light">
                <tr class="text-center">
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
                    <td class="text-center">
                        @if($konfirmasi->status_order == 'Menunggu Konfirmasi')
                            <a href="{{ route('konfirmasi.edit', $konfirmasi->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                        @endif
                        <a href="{{ route('konfirmasi.show', $konfirmasi->id) }}" class="btn btn-info btn-sm mb-1">Detail</a>
                        <form action="{{ route('konfirmasi.destroy', $konfirmasi->id) }}" method="POST" class="d-inline form-delete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                        </form>
                    </td>
                    <td>{{ $konfirmasi->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>{{ $konfirmasi->tgl_penjualan }}</td>
                    <td class="text-center">
                        @if($konfirmasi->url_resep)
                            <img src="{{ $konfirmasi->url_resep }}" alt="Resep" width="80" height="80"
                                 style="object-fit: cover; border-radius: 6px; cursor: pointer;"
                                 onclick="showModal('{{ $konfirmasi->url_resep }}')">
                        @else
                            - 
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="badge 
                            @if($konfirmasi->status_order == 'Menunggu Konfirmasi') 
                                badge-status-menunggu-konfirmasi
                            @elseif($konfirmasi->status_order == 'Dibatalkan Pembeli') 
                                badge-status-dibatalkan-pembeli
                            @else 
                                badge-status-default
                            @endif
                            p-2 text-white rounded-pill"
                            style="cursor: pointer;" 
                            data-bs-toggle="tooltip" 
                            title="Status: {{ $konfirmasi->status_order }}">
                            {{ $konfirmasi->status_order }}
                        </span>
                    </td>
                    <td>{{ $konfirmasi->keterangan_status ?? '-' }}</td>
                    <td>{{ $konfirmasi->created_at }}</td>
                    <td>{{ $konfirmasi->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
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
</script>
@endsection
