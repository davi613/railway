@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <a style="background-color:green;"  href="{{ route('pengiriman.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Pengiriman</a>

    <div class="card mb-4">
        <div style="background-color:orange;" class="card-header">Tambah Pengiriman</div>
        <h3 style="margin-top:20px;">Hanya Paket yang memiliki status "MENUNGGU KURIR" yang akan di tampilkan </h3>
        <div class="card-body">
            <form action="{{ route('pengiriman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- ID Penjualan -->
                <div class="mb-3">
                    <label for="id_penjualan" class="form-label">ID Penjualan</label>
                    <select style="color:black;" class="form-control" id="id_penjualan" name="id_penjualan" required>
                        <option  value="">Pilih ID Penjualan</option>
                        @foreach($penjualans as $penjualan)
                            <option value="{{ $penjualan->id }}">
                                {{ $penjualan->id }} - Rp {{ number_format($penjualan->total_bayar, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_penjualan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- No. Invoice -->
                <div class="mb-3">
                    <label for="no_invoice" class="form-label">No. Invoice</label>
                    <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="{{ rand(1000000, 9999999) }}" readonly>
                </div>

                <!-- Tanggal Kirim -->
                <div class="mb-3">
                    <label for="tgl_kirim" class="form-label">Tanggal Kirim</label>
                    <input type="datetime-local" class="form-control" id="tgl_kirim" name="tgl_kirim" required>
                    @error('tgl_kirim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nama Kurir -->
                <div class="mb-3">
                    <label for="nama_kurir" class="form-label">Nama Kurir</label>
                    <input type="text" class="form-control" id="nama_kurir" name="nama_kurir" required>
                    @error('nama_kurir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Telpon Kurir -->
                <div class="mb-3">
                    <label for="telpon_kurir" class="form-label">Telpon Kurir</label>
                    <input type="number" class="form-control" id="telpon_kurir" name="telpon_kurir" required>
                    @error('telpon_kurir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status Kirim -->
                <div  class="mb-3">
                    <label  for="status" class="form-label">Status Kirim</label>
                    <select style="color:black;" class="form-control" id="status" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="Sedang Dikirim">Sedang Dikirim</option>
                        <option value="Tiba Di Tujuan">Tiba di tujuan</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Bukti Foto -->
                <div class="mb-3">
                    <label for="bukti_foto" class="form-label">Bukti Foto</label>
                    <input type="file" class="form-control" id="bukti_foto" name="bukti_foto">
                    @error('bukti_foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                    @error('keterangan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengiriman</button>
                <a style="background-color: orange;" href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
