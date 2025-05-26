@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <h2 class="mb-4">DAFTAR PENGIRIMAN PAKET</h2>
    <h5 class="mb-4">Daftar pengiriman paket akan muncul ketika status paket diubah oleh "KARYAWAN" menjadi "MENUNGGU KURIR"</h5>


    <a href="{{ route('pengiriman.create') }}" class="btn btn-primary mb-3">Tambah Pengiriman</a>

    <div class="table-responsive">
        <table class="table table-bordered">
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
                        <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <!-- Form Hapus dengan SweetAlert -->
                        <form id="delete-form-{{ $pengiriman->id }}" action="{{ route('pengiriman.destroy', $pengiriman->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $pengiriman->id }})">Hapus</button>
                        </form>
                    </td>
                    <td>{{ $pengiriman->penjualan->id }}</td>
                    <td>{{ $pengiriman->no_invoice }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengiriman->tgl_kirim)->format('d-m-Y H:i') }}</td>
                    <td>{{ $pengiriman->tgl_tiba ? \Carbon\Carbon::parse($pengiriman->tgl_tiba)->format('d-m-Y') : 'Belum Tiba' }}</td>
                    <td>{{ $pengiriman->status_kirim }}</td>
                    <td>{{ $pengiriman->nama_kurir }}</td>
                    <td>{{ $pengiriman->telpon_kurir }}</td>
                    <td>
                        @if($pengiriman->bukti_foto)
                            {{-- <img src="{{ asset('storage/' . $pengiriman->bukti_foto) }}" alt="Bukti Foto" width="100"> --}}
                            <img src="{{ asset('storage/' . $pengiriman->bukti_foto) }}" 
                                alt="Bukti Foto" 
                                width="100" 
                                class="img-thumbnail" 
                                style="cursor:pointer;" 
                                onclick="tampilkanModalFoto('{{ asset('storage/' . $pengiriman->bukti_foto) }}')">
                        @else
                            Tidak ada bukti foto
                        @endif
                    </td>
                    <td>{{ $pengiriman->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal Preview Foto -->
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="previewFoto" src="" class="img-fluid rounded" style="max-height: 400px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

    </div>
</div>

<!-- SweetAlert2 Script untuk konfirmasi hapus -->
<!-- SweetAlert2 CDN -->
<script>
    function tampilkanModalFoto(src) {
        const preview = document.getElementById('previewFoto');
        preview.src = src;
        const modal = new bootstrap.Modal(document.getElementById('fotoModal'));
        modal.show();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
