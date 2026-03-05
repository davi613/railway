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
        <h1 class="bph-page-title">Jenis Pengiriman</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <span>Jenis Pengiriman</span>
        </div>
    </div>
    <a href="{{ route('jenis_pengiriman.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Tambah Pengiriman
    </a>
</div>

<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-send-fill"></i>
            Daftar Jenis Pengiriman
        </div>
        <form method="GET" action="{{ route('jenis_pengiriman.index') }}" style="display:flex; gap:8px;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" name="search" class="bph-search-input"
                    placeholder="Cari ekspedisi..." value="{{ request('search') }}">
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
                        <th style="text-align:center;">Aksi</th>
                        <th style="text-align:center;">No</th>
                        <th>Jenis Kirim</th>
                        <th>Nama Ekspedisi</th>
                        <th>Ongkos Kirim</th>
                        <th style="text-align:center;">Logo</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenisPengiriman as $no => $item)
                        <tr>
                            <td style="text-align:center;">
                                <div style="display:flex; gap:6px; justify-content:center;">
                                    <a href="{{ route('jenis_pengiriman.edit', $item->id) }}"
                                        class="bph-btn bph-btn-primary bph-btn-sm bph-btn-ico" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                        class="bph-btn bph-btn-danger bph-btn-sm bph-btn-ico" title="Hapus"
                                        onclick="bphConfirmDelete({{ $item->id }})">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <form id="del-{{ $item->id }}" action="{{ route('jenis_pengiriman.destroy', $item->id) }}" method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            <td style="text-align:center; font-weight:800;">{{ $jenisPengiriman->firstItem() + $no }}</td>
                            <td>
                                <span class="bph-badge bph-badge-orange">{{ ucfirst($item->jenis_kirim) }}</span>
                            </td>
                            <td style="font-weight:700;">{{ $item->nama_ekspedisi }}</td>
                            <td style="font-weight:800; color:var(--bph-orange);">
                                Rp {{ number_format($item->ongkos_kirim, 0, ',', '.') }}
                            </td>
                            <td style="text-align:center;">
                                @if ($item->logo_ekspedisi)
                                    <img src="{{ asset('storage/' . $item->logo_ekspedisi) }}" alt="Logo"
                                        style="width:44px; height:44px; object-fit:contain; border-radius:8px; border:1px solid var(--bph-border); padding:4px; cursor:pointer; background:#fff;"
                                        data-bs-toggle="modal" data-bs-target="#bphLogoModal"
                                        data-logo="{{ asset('storage/' . $item->logo_ekspedisi) }}"
                                        data-name="{{ $item->nama_ekspedisi }}">
                                @else
                                    <span style="color:var(--bph-muted);">—</span>
                                @endif
                            </td>
                            <td style="font-size:0.79rem; color:var(--bph-muted);">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td style="font-size:0.79rem; color:var(--bph-muted);">{{ \Carbon\Carbon::parse($item->updated_at)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="bph-empty">
                                    <i class="bi bi-send"></i>
                                    <p>Belum ada data jenis pengiriman.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($jenisPengiriman->hasPages())
            <div class="bph-pagination">
                @if ($jenisPengiriman->onFirstPage())
                    <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
                @else
                    <a class="bph-page-btn" href="{{ $jenisPengiriman->previousPageUrl() }}&search={{ request('search') }}"><i class="bi bi-chevron-left"></i> Prev</a>
                @endif
                @if ($jenisPengiriman->hasMorePages())
                    <a class="bph-page-btn" href="{{ $jenisPengiriman->nextPageUrl() }}&search={{ request('search') }}">Next <i class="bi bi-chevron-right"></i></a>
                @else
                    <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Logo Modal -->
<div class="modal fade" id="bphLogoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:14px; border:none; overflow:hidden;">
            <div class="modal-header" style="background:var(--bph-orange); border:none; padding:16px 20px;">
                <h5 class="modal-title" id="bphLogoTitle" style="color:#fff; font-weight:800; margin:0;"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="text-align:center; padding:32px; background:var(--bph-bg);">
                <img src="" id="bphLogoPreview" alt="Logo"
                    style="max-height:60vh; max-width:100%; object-fit:contain; border-radius:10px;">
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function bphConfirmDelete(id) {
    Swal.fire({
        title: 'Hapus Jenis Pengiriman?',
        text: 'Data ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#F97316',
        reverseButtons: true
    }).then(r => { if (r.isConfirmed) document.getElementById('del-' + id).submit(); });
}
var bphModal = document.getElementById('bphLogoModal');
if (bphModal) {
    bphModal.addEventListener('show.bs.modal', function (e) {
        document.getElementById('bphLogoTitle').textContent = e.relatedTarget.getAttribute('data-name');
        document.getElementById('bphLogoPreview').src = e.relatedTarget.getAttribute('data-logo');
    });
}
</script>
@endsection
