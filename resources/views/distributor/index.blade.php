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
        <h1 class="bph-page-title">Manajemen Distributor</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <span>Distributor</span>
        </div>
    </div>
    <a href="{{ route('distributor.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-circle-fill"></i> Tambah Distributor
    </a>
</div>

<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-truck"></i>
            Daftar Distributor
        </div>
        <form action="{{ route('distributor.index') }}" method="GET" style="display:flex; gap:8px;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" name="search" class="bph-search-input"
                    placeholder="Cari distributor..." value="{{ request('search') }}">
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
                        <th style="text-align:center;">No.</th>
                        <th>Nama Distributor</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($distributors as $no => $distributor)
                        <tr>
                            <td style="text-align:center;">
                                <div style="display:flex; gap:6px; justify-content:center;">
                                    <a href="{{ route('distributor.edit', $distributor->id) }}"
                                        class="bph-btn bph-btn-primary bph-btn-sm bph-btn-ico" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button"
                                        class="bph-btn bph-btn-danger bph-btn-sm bph-btn-ico" title="Hapus"
                                        onclick="bphConfirmDelete({{ $distributor->id }})">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                    <form id="del-{{ $distributor->id }}" action="{{ route('distributor.destroy', $distributor->id) }}" method="POST" style="display:none;">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </td>
                            <td style="text-align:center; font-weight:800;">{{ $distributors->firstItem() + $no }}</td>
                            <td style="font-weight:700; text-transform:capitalize;">{{ $distributor->nama_distributor }}</td>
                            <td>
                                <span class="bph-badge bph-badge-gray">
                                    <i class="bi bi-telephone"></i> {{ $distributor->telepon }}
                                </span>
                            </td>
                            <td style="font-size:0.82rem; color:var(--bph-muted); max-width:200px;">{{ $distributor->alamat }}</td>
                            <td style="font-size:0.79rem; color:var(--bph-muted);">{{ \Carbon\Carbon::parse($distributor->created_at)->format('d M Y') }}</td>
                            <td style="font-size:0.79rem; color:var(--bph-muted);">{{ \Carbon\Carbon::parse($distributor->updated_at)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="bph-empty">
                                    <i class="bi bi-truck"></i>
                                    <p>Belum ada data distributor.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($distributors->hasPages())
            <div class="bph-pagination">
                @if ($distributors->onFirstPage())
                    <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
                @else
                    <a class="bph-page-btn" href="{{ $distributors->previousPageUrl() }}&search={{ request('search') }}" rel="prev"><i class="bi bi-chevron-left"></i> Prev</a>
                @endif
                @if ($distributors->hasMorePages())
                    <a class="bph-page-btn" href="{{ $distributors->nextPageUrl() }}&search={{ request('search') }}" rel="next">Next <i class="bi bi-chevron-right"></i></a>
                @else
                    <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
                @endif
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function bphConfirmDelete(id) {
    Swal.fire({
        title: 'Hapus Distributor?',
        text: 'Data ini akan dihapus secara permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#EF4444',
        cancelButtonColor: '#F97316',
        reverseButtons: true
    }).then(result => { if (result.isConfirmed) document.getElementById('del-' + id).submit(); });
}
</script>
@endsection
