@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('navbar')
    @include('be.navbar')
@endsection
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-white shadow rounded p-4">
                    <div class="border-bottom pb-3 mb-4">
                        <h3 class="text-primary">✏️ Edit Jenis Pengiriman</h3>
                        <p class="text-muted mb-0">Perbarui data pengiriman dengan benar dan lengkap.</p>
                    </div>

                    <form action="{{ route('jenis_pengiriman.update', $jenisPengiriman->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="jenis_kirim" class="form-label fw-bold">Jenis Kirim *</label>
                            <select class="form-select border-primary" id="jenis_kirim" name="jenis_kirim" required>
                                <option value="ekonomi" {{ $jenisPengiriman->jenis_kirim == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                <option value="kargo" {{ $jenisPengiriman->jenis_kirim == 'kargo' ? 'selected' : '' }}>Kargo</option>
                                <option value="regular" {{ $jenisPengiriman->jenis_kirim == 'regular' ? 'selected' : '' }}>Regular</option>
                                <option value="same day" {{ $jenisPengiriman->jenis_kirim == 'same day' ? 'selected' : '' }}>Same Day</option>
                                <option value="standar" {{ $jenisPengiriman->jenis_kirim == 'standar' ? 'selected' : '' }}>Standar</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="nama_ekspedisi" class="form-label fw-bold">Nama Ekspedisi *</label>
                            <input type="text" class="form-control border-primary" id="nama_ekspedisi" name="nama_ekspedisi" 
                                   value="{{ $jenisPengiriman->nama_ekspedisi }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="ongkos_kirim" class="form-label fw-bold">Ongkos Kirim *</label>
                            <input type="number" class="form-control border-primary" id="ongkos_kirim" name="ongkos_kirim" 
                                   value="{{ $jenisPengiriman->ongkos_kirim }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="logo_ekspedisi" class="form-label fw-bold">Logo Ekspedisi</label>
                            <input type="file" class="form-control border-secondary" id="logo_ekspedisi" name="logo_ekspedisi" accept="image/*">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>

                            @if($jenisPengiriman->logo_ekspedisi)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/'.$jenisPengiriman->logo_ekspedisi) }}" alt="Logo" width="120" class="img-thumbnail border border-secondary">
                                    <div class="form-text">Logo saat ini</div>
                                </div>
                            @endif
                        </div>

                        <div style="color:white;" class="text-end mt-4">
                            <a style="color:white;background-color:red" href="{{ route('jenis_pengiriman.index') }}" class="btn btn-outline-danger me-2">
                                ❌ Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                💾 Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
