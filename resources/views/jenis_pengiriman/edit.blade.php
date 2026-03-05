@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('navbar')
    @include('be.navbar')
@endsection

@section('content')

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Edit Jenis Pengiriman</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <a href="{{ route('jenis_pengiriman.index') }}">Jenis Pengiriman</a>
            <span class="sep">/</span>
            <span>Edit</span>
        </div>
    </div>
    <a href="{{ route('jenis_pengiriman.index') }}" class="bph-btn bph-btn-outline">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="bph-card" style="max-width:680px;">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-pencil-square"></i>
            Form Edit Jenis Pengiriman
        </div>
    </div>
    <div class="bph-card-body">
        <form action="{{ route('jenis_pengiriman.update', $jenisPengiriman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bph-form-group">
                <label class="bph-label" for="jenis_kirim">Jenis Kirim <span class="req">*</span></label>
                <select class="bph-select" id="jenis_kirim" name="jenis_kirim" required>
                    <option value="ekonomi"  {{ $jenisPengiriman->jenis_kirim == 'ekonomi'  ? 'selected' : '' }}>Ekonomi</option>
                    <option value="kargo"    {{ $jenisPengiriman->jenis_kirim == 'kargo'    ? 'selected' : '' }}>Kargo</option>
                    <option value="regular"  {{ $jenisPengiriman->jenis_kirim == 'regular'  ? 'selected' : '' }}>Regular</option>
                    <option value="same day" {{ $jenisPengiriman->jenis_kirim == 'same day' ? 'selected' : '' }}>Same Day</option>
                    <option value="standar"  {{ $jenisPengiriman->jenis_kirim == 'standar'  ? 'selected' : '' }}>Standar</option>
                </select>
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="nama_ekspedisi">Nama Ekspedisi <span class="req">*</span></label>
                <input type="text" class="bph-input" id="nama_ekspedisi" name="nama_ekspedisi"
                    value="{{ $jenisPengiriman->nama_ekspedisi }}" required
                    placeholder="Contoh: JNE, J&T, Tiki...">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="ongkos_kirim">Ongkos Kirim <span class="req">*</span></label>
                <input type="number" class="bph-input" id="ongkos_kirim" name="ongkos_kirim"
                    value="{{ $jenisPengiriman->ongkos_kirim }}" required
                    placeholder="Masukkan nominal">
            </div>

            <div class="bph-form-group">
                <label class="bph-label" for="logo_ekspedisi">Logo Ekspedisi</label>
                <input type="file" class="bph-file-input" id="logo_ekspedisi" name="logo_ekspedisi" accept="image/*">
                <div class="bph-form-hint">Biarkan kosong jika tidak ingin mengubah logo.</div>

                @if($jenisPengiriman->logo_ekspedisi)
                    <div style="margin-top:12px; display:flex; align-items:center; gap:14px; padding:14px; background:var(--bph-bg); border-radius:9px; border:1px solid var(--bph-border);">
                        <img src="{{ asset('storage/'.$jenisPengiriman->logo_ekspedisi) }}" alt="Logo"
                            style="width:52px; height:52px; object-fit:contain; border-radius:8px; border:1px solid var(--bph-border); padding:4px; background:#fff;">
                        <div>
                            <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.05em; color:var(--bph-muted);">Logo Saat Ini</div>
                            <div style="font-weight:700; color:var(--bph-dark); margin-top:2px;">{{ $jenisPengiriman->nama_ekspedisi }}</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="bph-form-divider"></div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <a href="{{ route('jenis_pengiriman.index') }}" class="bph-btn bph-btn-outline">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="bph-btn bph-btn-primary">
                    <i class="bi bi-check-circle-fill"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
