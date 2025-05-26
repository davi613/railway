@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Status Penjualan</h2>

    <form action="{{ route('konfirmasi.update', $konfirmasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status_order" class="form-label">Status Order</label>
            <select style="color:black;" name="status_order" id="status_order" class="form-control" required>
                {{-- <option value="Menunggu Konfirmasi" {{ $konfirmasi->status_order == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option> --}}
                <option value="Diproses" {{ $konfirmasi->status_order == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                {{-- <option value="Menunggu Kurir" {{ $konfirmasi->status_order == 'Menunggu Kurir' ? 'selected' : '' }}>Menunggu Kurir</option> --}}
                {{-- <option value="Dibatalkan Pembeli" {{ $konfirmasi->status_order == 'Dibatalkan Pembeli' ? 'selected' : '' }}>Dibatalkan Pembeli</option> --}}
                <option value="Dibatalkan Penjual" {{ $konfirmasi->status_order == 'Dibatalkan Penjual' ? 'selected' : '' }}>Dibatalkan Penjual</option>
                <option value="Bermasalah" {{ $konfirmasi->status_order == 'Bermasalah' ? 'selected' : '' }}>Bermasalah</option>
                {{-- <option value="Selesai" {{ $konfirmasi->status_order == 'Selesai' ? 'selected' : '' }}>Selesai</option> --}}
            </select>
        </div>

        <div class="mb-3">
            <label for="keterangan_status" class="form-label">Keterangan Status (Opsional)</label>
            <textarea name="keterangan_status" id="keterangan_status" class="form-control" rows="3">{{ old('keterangan_status', $konfirmasi->keterangan_status) }}</textarea>
        </div>

        <a href="{{ route('konfirmasi.index') }}" class="btn btn-danger">Batal</a>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    @endif
</script>
@endsection
