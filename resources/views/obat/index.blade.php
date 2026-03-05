@extends('be.master')
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('navbar')
    @include('be.navbar')
@endsection
@section('content')
<style>
    .bph-page-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .bph-page-title {
        font-size: 1.55rem;
        font-weight: 800;
        color: #1A1A2E;
        margin: 0 0 4px 0;
    }
    .bph-breadcrumb {
        font-size: 0.82rem;
        color: #8A8FA8;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .bph-breadcrumb a { color: #F97316; text-decoration: none; font-weight: 600; }
    .bph-breadcrumb .sep { color: #CBD5E1; }

    .bph-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        border-radius: 10px;
        font-size: 0.88rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    }
    .bph-btn:hover { transform: translateY(-1px); }
    .bph-btn-primary { background: linear-gradient(135deg,#F97316,#FDBA74); color:#fff; box-shadow:0 4px 14px rgba(249,115,22,0.25); }
    .bph-btn-primary:hover { background: linear-gradient(135deg,#EA6C0A,#F97316); color:#fff; }
    .bph-btn-danger { background: #EF4444; color:#fff; }
    .bph-btn-danger:hover { background: #DC2626; color:#fff; }
    .bph-btn-warning { background: #F97316; color:#fff; }
    .bph-btn-warning:hover { background: #EA6C0A; color:#fff; }
    .bph-btn-sm { padding: 6px 13px; font-size: 0.8rem; border-radius: 8px; }

    .bph-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(30,30,60,0.08);
        border: 1.5px solid #F1F5F9;
        margin-bottom: 28px;
        overflow: hidden;
    }
    .bph-card-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 28px;
        border-bottom: 1.5px solid #F1F5F9;
        flex-wrap: wrap;
        gap: 12px;
    }
    .bph-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1A1A2E;
        display: flex;
        align-items: center;
        gap: 9px;
    }
    .bph-card-title i { color: #F97316; font-size: 1.1rem; }
    .bph-card-body { padding: 24px 28px; }

    .bph-search {
        position: relative;
        display: flex;
        align-items: center;
    }
    .bph-search-icon {
        position: absolute;
        left: 12px;
        color: #F97316;
        font-size: 0.95rem;
    }
    .bph-search-input {
        padding: 8px 14px 8px 36px;
        border-radius: 10px;
        border: 1.5px solid #E2E8F0;
        font-size: 0.88rem;
        outline: none;
        transition: border 0.2s;
        min-width: 240px;
        background: #FAFAFA;
    }
    .bph-search-input:focus { border-color: #F97316; background: #fff; }
    .bph-search-btn {
        margin-left: 8px;
        padding: 8px 18px;
        border-radius: 10px;
        border: none;
        background: linear-gradient(135deg,#F97316,#FDBA74);
        color: #fff;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .bph-search-btn:hover { background: linear-gradient(135deg,#EA6C0A,#F97316); }

    .bph-table-scroll { overflow-x: auto; }
    .bph-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 0.875rem;
    }
    .bph-table thead tr {
        background: linear-gradient(90deg, #1A1A2E 0%, #2D2D4E 100%);
    }
    .bph-table thead th {
        padding: 13px 14px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #F97316;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        white-space: nowrap;
        text-align: center;
    }
    .bph-table tbody tr {
        border-bottom: 1px solid #F1F5F9;
        transition: background 0.15s;
    }
    .bph-table tbody tr:hover { background: #FFF7ED; }
    .bph-table tbody td {
        padding: 12px 14px;
        color: #334155;
        vertical-align: middle;
        text-align: center;
        border: none;
    }
    .bph-table tbody td:nth-child(4),
    .bph-table tbody td:nth-child(5) { font-weight: 700; }

    .bph-pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
        padding: 20px 28px;
        border-top: 1.5px solid #F1F5F9;
    }
    .bph-page-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 8px 18px;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 700;
        border: 1.5px solid #F97316;
        color: #F97316;
        background: #fff;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .bph-page-btn:hover { background: #F97316; color: #fff; }
    .bph-page-btn.disabled {
        border-color: #E2E8F0;
        color: #CBD5E1;
        cursor: not-allowed;
        pointer-events: none;
    }

    .bph-empty { text-align: center; padding: 40px; color: #94A3B8; }
    .bph-empty i { font-size: 2.2rem; display: block; margin-bottom: 10px; color: #F97316; }

    .bph-preview-img {
        width: 48px; height: 48px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #F97316;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .bph-preview-img:hover { transform: scale(1.1); }

    .bph-img-modal-overlay {
        position: fixed;
        top:0; left:0; right:0; bottom:0;
        background: rgba(0,0,0,0.75);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        cursor: pointer;
    }
    .bph-img-modal-overlay.show { display: flex; }
    .bph-img-modal-img {
        max-width: 70%;
        max-height: 70vh;
        border-radius: 14px;
        border: 4px solid #fff;
        box-shadow: 0 8px 40px rgba(0,0,0,0.3);
    }
    .bph-img-modal-close {
        position: absolute;
        top: 22px; right: 32px;
        font-size: 2.2rem;
        color: #fff;
        cursor: pointer;
        font-weight: 700;
        line-height: 1;
    }
</style>

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Daftar Obat</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <span>Dashboard</span>
            <span class="sep">/</span>
            <span>Obat</span>
        </div>
    </div>
    <a href="{{ route('obat.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Obat
    </a>
</div>

<!-- Card -->
<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-capsule"></i> Data Obat
        </div>
        <form action="{{ route('obat.index') }}" method="GET" style="display:flex; align-items:center; gap:0;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" name="search" class="bph-search-input" placeholder="Cari nama atau jenis obat..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="bph-search-btn"><i class="bi bi-search"></i> Cari</button>
        </form>
    </div>

    <div class="bph-table-scroll">
        <table class="bph-table">
            <thead>
                <tr>
                    <th>Aksi</th>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Jenis Obat</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Foto 1</th>
                    <th>Foto 2</th>
                    <th>Foto 3</th>
                    <th>Dibuat</th>
                    <th>Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($obats as $no => $obat)
                    <tr>
                        <td>
                            <div style="display:flex; gap:5px; justify-content:center;">
                                <a href="{{ route('obat.edit', $obat->id) }}" class="bph-btn bph-btn-warning bph-btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" class="d-inline form-hapus">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bph-btn bph-btn-danger bph-btn-sm">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td><strong>{{ $obats->firstItem() + $no }}.</strong></td>
                        <td style="font-weight:700; text-align:left;">{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->jenisObat->jenis }}</td>
                        <td style="font-weight:700; color:#F97316;">{{ $obat->harga_jual }}</td>
                        <td>
                            <span style="background:#FFF7ED; color:#F97316; font-weight:700; padding:3px 12px; border-radius:20px; font-size:0.82rem;">
                                {{ $obat->stok }}
                            </span>
                        </td>
                        <td style="text-align:left;">{{ \Str::limit($obat->deskripsi_obat, 20, '...') }}</td>
                        <td>
                            @if ($obat->foto1)
                                <img src="{{ asset('storage/' . $obat->foto1) }}" alt="Foto 1" class="bph-preview-img" data-src="{{ asset('storage/' . $obat->foto1) }}">
                            @else <span style="color:#CBD5E1;">-</span> @endif
                        </td>
                        <td>
                            @if ($obat->foto2)
                                <img src="{{ asset('storage/' . $obat->foto2) }}" alt="Foto 2" class="bph-preview-img" data-src="{{ asset('storage/' . $obat->foto2) }}">
                            @else <span style="color:#CBD5E1;">-</span> @endif
                        </td>
                        <td>
                            @if ($obat->foto3)
                                <img src="{{ asset('storage/' . $obat->foto3) }}" alt="Foto 3" class="bph-preview-img" data-src="{{ asset('storage/' . $obat->foto3) }}">
                            @else <span style="color:#CBD5E1;">-</span> @endif
                        </td>
                        <td style="font-size:0.78rem; color:#94A3B8;">{{ $obat->created_at->format('d/m/Y H:i') }}</td>
                        <td style="font-size:0.78rem; color:#94A3B8;">{{ $obat->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12">
                            <div class="bph-empty">
                                <i class="bi bi-inbox"></i>
                                <p>Data tidak ditemukan.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($obats->hasPages())
        <div class="bph-pagination">
            @if ($obats->onFirstPage())
                <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
            @else
                <a class="bph-page-btn" href="{{ $obats->previousPageUrl() }}"><i class="bi bi-chevron-left"></i> Prev</a>
            @endif
            @if ($obats->hasMorePages())
                <a class="bph-page-btn" href="{{ $obats->nextPageUrl() }}">Next <i class="bi bi-chevron-right"></i></a>
            @else
                <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
            @endif
        </div>
    @endif
</div>

<!-- Image Preview Modal -->
<div class="bph-img-modal-overlay" id="bphImgModal">
    <span class="bph-img-modal-close" id="bphImgClose">&times;</span>
    <img class="bph-img-modal-img" id="bphImgPreview" src="" alt="Preview">
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.bph-preview-img').forEach(img => {
        img.addEventListener('click', function () {
            document.getElementById('bphImgPreview').src = this.getAttribute('data-src');
            document.getElementById('bphImgModal').classList.add('show');
        });
    });
    document.getElementById('bphImgModal').addEventListener('click', function () {
        this.classList.remove('show');
    });
    document.getElementById('bphImgClose').addEventListener('click', function (e) {
        e.stopPropagation();
        document.getElementById('bphImgModal').classList.remove('show');
    });

    document.querySelectorAll('.form-hapus').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang dihapus tidak bisa dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#F97316',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endsection
