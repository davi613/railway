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
        <h1 class="bph-page-title">Daftar Pelanggan</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <span>User Pelanggan</span>
        </div>
    </div>
</div>

<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-people-fill"></i>
            Data Pelanggan Terdaftar
        </div>
        <form action="{{ route('costumer.index') }}" method="GET" style="display:flex; gap:8px; align-items:center;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" name="search" class="bph-search-input"
                    placeholder="Cari nama atau email..." value="{{ $search ?? '' }}">
            </div>
            <button type="submit" class="bph-btn bph-btn-primary bph-btn-sm">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>

    <div class="bph-card-body-flush">
        <div class="bph-table-scroll">
            <table class="bph-table">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Alamat 1</th>
                        <th>Alamat 2</th>
                        <th>Alamat 3</th>
                        <th style="text-align:center;">Foto</th>
                        <th style="text-align:center;">KTP</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pelanggans->isEmpty())
                        <tr>
                            <td colspan="9">
                                <div class="bph-empty">
                                    <i class="bi bi-people"></i>
                                    <p>
                                        @if (request('search'))
                                            Data tidak ditemukan untuk: <strong>"{{ request('search') }}"</strong>
                                        @else
                                            Belum ada data pelanggan.
                                        @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach($pelanggans as $index => $pelanggan)
                        <tr>
                            <td style="text-align:center; font-weight:800;">{{ $pelanggans->firstItem() + $index }}</td>
                            <td style="font-weight:700;">{{ $pelanggan->nama_pelanggan }}</td>
                            <td style="font-size:0.82rem; color:var(--bph-muted);">{{ $pelanggan->email }}</td>
                            <td>{{ $pelanggan->no_telp }}</td>
                            <td>
                                <div style="font-size:0.79rem; line-height:1.7;">
                                    <div><span style="font-weight:700; color:var(--bph-muted);">Jalan:</span> {{ Str::limit($pelanggan->alamat1, 20) }}</div>
                                    <div><span style="font-weight:700; color:var(--bph-muted);">Kota:</span> {{ Str::limit($pelanggan->kota1, 15) }}</div>
                                    <div><span style="font-weight:700; color:var(--bph-muted);">Prov:</span> {{ Str::limit($pelanggan->provinsi1, 15) }}</div>
                                    <div><span style="font-weight:700; color:var(--bph-muted);">Kode:</span> {{ $pelanggan->kodepos1 }}</div>
                                </div>
                            </td>
                            <td>
                                @if ($pelanggan->alamat2)
                                    <div style="font-size:0.79rem; line-height:1.7;">
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Jalan:</span> {{ Str::limit($pelanggan->alamat2, 20) }}</div>
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Kota:</span> {{ Str::limit($pelanggan->kota2, 15) }}</div>
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Prov:</span> {{ Str::limit($pelanggan->provinsi2, 15) }}</div>
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Kode:</span> {{ $pelanggan->kodepos2 }}</div>
                                    </div>
                                @else
                                    <span class="bph-badge bph-badge-yellow">Kosong</span>
                                @endif
                            </td>
                            <td>
                                @if ($pelanggan->alamat3)
                                    <div style="font-size:0.79rem; line-height:1.7;">
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Jalan:</span> {{ Str::limit($pelanggan->alamat3, 20) }}</div>
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Kota:</span> {{ Str::limit($pelanggan->kota3, 15) }}</div>
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Prov:</span> {{ Str::limit($pelanggan->provinsi3, 15) }}</div>
                                        <div><span style="font-weight:700; color:var(--bph-muted);">Kode:</span> {{ $pelanggan->kodepos3 }}</div>
                                    </div>
                                @else
                                    <span class="bph-badge bph-badge-yellow">Kosong</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                @if($pelanggan->foto)
                                    <button type="button" class="bph-btn bph-btn-success bph-btn-sm bph-lihat-img" data-img="{{ asset('storage/' . $pelanggan->foto) }}" title="Lihat Foto">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                @else
                                    <span class="bph-badge bph-badge-red">Tidak Ada</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                @if($pelanggan->url_ktp)
                                    <button type="button" class="bph-btn bph-btn-primary bph-btn-sm bph-lihat-img" data-img="{{ asset('storage/' . $pelanggan->url_ktp) }}" title="Lihat KTP">
                                        <i class="bi bi-eye-fill"></i> Lihat
                                    </button>
                                @else
                                    <span class="bph-badge bph-badge-red">Tidak Ada</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        @if ($pelanggans->hasPages())
            <div class="bph-pagination">
                @if ($pelanggans->onFirstPage())
                    <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
                @else
                    <a class="bph-page-btn" href="{{ $pelanggans->previousPageUrl() }}" rel="prev"><i class="bi bi-chevron-left"></i> Prev</a>
                @endif
                @if ($pelanggans->hasMorePages())
                    <a class="bph-page-btn" href="{{ $pelanggans->nextPageUrl() }}" rel="next">Next <i class="bi bi-chevron-right"></i></a>
                @else
                    <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
                @endif
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if (session('success'))
    Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}', confirmButtonColor:'#F97316' });
@endif

document.querySelectorAll('.bph-lihat-img').forEach(function(btn) {
    btn.addEventListener('click', function () {
        Swal.fire({
            title: 'Preview Gambar',
            imageUrl: this.getAttribute('data-img'),
            imageAlt: 'Gambar',
            showCloseButton: true,
            showConfirmButton: false,
            width: '600px'
        });
    });
});
</script>
@endsection
