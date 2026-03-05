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
        <h1 class="bph-page-title">Jenis Pembayaran</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <span>Jenis Pembayaran</span>
        </div>
    </div>
    <a href="{{ route('metode_bayar.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Tambah Metode
    </a>
</div>

<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-credit-card-2-front-fill"></i>
            Daftar Metode Pembayaran
        </div>
        <form method="GET" action="{{ route('metode_bayar.index') }}" style="display:flex; gap:8px;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" name="search" class="bph-search-input"
                    placeholder="Cari metode..." value="{{ request('search') }}">
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
                        <th>Metode Pembayaran</th>
                        <th>Tempat Bayar</th>
                    
                        <th style="text-align:center;">Logo</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($metodeBayars as $no => $item)
                        <tr>
                            <td style="text-align:center;">
                                <div style="display:flex; gap:6px; justify-content:center;">
                                    <a href="{{ route('metode_bayar.edit', $item->id) }}"
                                        class="bph-btn bph-btn-primary bph-btn-sm bph-btn-ico" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                        class="bph-btn bph-btn-danger bph-btn-sm bph-btn-ico" title="Hapus"
                                        onclick="bphConfirmDelete({{ $item->id }})">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <form id="del-{{ $item->id }}" action="{{ route('metode_bayar.destroy', $item->id) }}" method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            <td style="text-align:center; font-weight:800;">{{ $metodeBayars->firstItem() + $no }}</td>
                            <td style="font-weight:700;">{{ $item->metode_pembayaran }}</td>
                            <td>{{ $item->tempat_bayar }}</td>
                            {{-- <td style="font-family:monospace; font-size:0.82rem;">{{ $item->no_rekening ?? '—' }}</td> --}}
                            <td style="text-align:center;">
                                @if ($item->url_logo)
                                    <img src="{{ asset('storage/' . $item->url_logo) }}" alt="Logo"
                                        style="width:44px; height:44px; object-fit:contain; border-radius:8px; border:1px solid var(--bph-border); padding:4px; cursor:pointer; background:#fff;"
                                        data-bs-toggle="modal" data-bs-target="#bphLogoModal"
                                        data-logo="{{ asset('storage/' . $item->url_logo) }}"
                                        data-name="{{ $item->metode_pembayaran }}">
                                @else
                                    <span style="color:var(--bph-muted);">—</span>
                                @endif
                            </td>
                            <td style="font-size:0.79rem; color:var(--bph-muted);">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                            <td style="font-size:0.79rem; color:var(--bph-muted);">{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach

                    @if ($metodeBayars->isEmpty())
                        <tr>
                            <td colspan="8">
                                <div class="bph-empty">
                                    <i class="bi bi-credit-card-2-front"></i>
                                    <p>Belum ada data metode pembayaran.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if ($metodeBayars->hasPages())
            <div class="bph-pagination">
                @if ($metodeBayars->onFirstPage())
                    <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
                @else
                    <a class="bph-page-btn" href="{{ $metodeBayars->previousPageUrl() }}&search={{ request('search') }}"><i class="bi bi-chevron-left"></i> Prev</a>
                @endif
                @if ($metodeBayars->hasMorePages())
                    <a class="bph-page-btn" href="{{ $metodeBayars->nextPageUrl() }}&search={{ request('search') }}">Next <i class="bi bi-chevron-right"></i></a>
                @else
                    <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Logo Preview Modal -->
<div class="modal fade" id="bphLogoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius:14px; border:none; overflow:hidden;">
            <div class="modal-header" style="background:var(--bph-orange); border:none; padding:16px 20px;">
                <h5 class="modal-title" id="bphLogoModalTitle" style="color:#fff; font-weight:800; margin:0;"></h5>
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
        title: 'Hapus Metode Pembayaran?',
        text: 'Data ini akan dihapus secara permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#F97316'
    }).then(r => { if (r.isConfirmed) document.getElementById('del-' + id).submit(); });
}

var bphModal = document.getElementById('bphLogoModal');
if (bphModal) {
    bphModal.addEventListener('show.bs.modal', function (e) {
        var img = e.relatedTarget;
        document.getElementById('bphLogoModalTitle').textContent = img.getAttribute('data-name');
        document.getElementById('bphLogoPreview').src = img.getAttribute('data-logo');
    });
}
</script>
@endsection
