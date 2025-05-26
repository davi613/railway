@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <h1>Edit Pengiriman</h1>

    <form action="{{ route('pengiriman.update', $pengiriman->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        

        <div class="form-group">
            <label for="tgl_kirim">Tanggal Kirim</label>
            <input type="datetime-local" name="tgl_kirim" id="tgl_kirim" class="form-control" value="{{ \Carbon\Carbon::parse($pengiriman->tgl_kirim)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="form-group">
            <label for="tgl_tiba">Tanggal Tiba</label>
            <input type="date" name="tgl_tiba" id="tgl_tiba" class="form-control" value="{{ $pengiriman->tgl_tiba }}">
        </div>

<div class="form-group">
    <label for="status">Status Pengiriman</label>
    <select style="color:black;" name="status" id="status" class="form-control" required>
        <option value="Sedang Dikirim" {{ $pengiriman->status_kirim == 'Sedang Dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
        <option value="Tiba Di Tujuan" {{ $pengiriman->status_kirim == 'Tiba Di Tujuan' ? 'selected' : '' }}>Tiba Di Tujuan</option>
    </select>
    @error('status')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

        <div class="form-group">
            <label for="nama_kurir">Nama Kurir</label>
            <input type="text" name="nama_kurir" id="nama_kurir" class="form-control" value="{{ $pengiriman->nama_kurir }}" required>
        </div>

        <div class="form-group">
            <label for="telpon_kurir">Telpon Kurir</label>
            <input type="text" name="telpon_kurir" id="telpon_kurir" class="form-control" value="{{ $pengiriman->telpon_kurir }}" required>
        </div>

        <div class="form-group">
            <label for="bukti_foto">Bukti Foto</label>
            @if($pengiriman->bukti_foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $pengiriman->bukti_foto) }}" alt="Bukti Foto" width="100">
                </div>
            @endif
            <input type="file" name="bukti_foto" id="bukti_foto" class="form-control">
        </div>

        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="form-control">{{ $pengiriman->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a style="background-color: orange;" href="{{ route('pengiriman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection

