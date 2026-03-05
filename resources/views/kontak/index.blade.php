@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-alert-success { background:#F0FDF4; border:1.5px solid #BBF7D0; color:#15803D; padding:12px 18px; border-radius:10px; margin-bottom:20px; display:flex; align-items:center; gap:9px; font-weight:600; font-size:0.9rem; }

    .bph-inbox-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; overflow:hidden; margin-bottom:28px; }
    .bph-inbox-head { padding:20px 28px; border-bottom:1.5px solid #F1F5F9; background:linear-gradient(90deg,#1A1A2E,#2D2D4E); display:flex; align-items:center; gap:10px; }
    .bph-inbox-head h3 { margin:0; font-size:1.1rem; font-weight:800; color:#F97316; display:flex; align-items:center; gap:9px; }

    .bph-msg-item { padding:24px 28px; border-bottom:1px solid #F8FAFC; transition:background 0.15s; }
    .bph-msg-item:last-child { border-bottom:none; }
    .bph-msg-item:hover { background:#FFFBF7; }
    .bph-msg-subject { font-size:1rem; font-weight:700; color:#1A1A2E; margin-bottom:8px; }
    .bph-msg-meta { font-size:0.82rem; color:#94A3B8; margin-bottom:4px; }
    .bph-msg-meta strong { color:#64748B; }
    .bph-msg-body { font-size:0.9rem; color:#334155; margin-top:10px; line-height:1.65; background:#FAFAFA; border-radius:10px; padding:12px 16px; border-left:3px solid #F97316; }

    .bph-msg-actions { display:flex; gap:10px; margin-top:14px; flex-wrap:wrap; }
    .bph-btn { display:inline-flex; align-items:center; gap:6px; padding:7px 16px; border-radius:9px; font-size:0.82rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-reply { background:#EFF6FF; color:#1D4ED8; border:1.5px solid #BFDBFE; }
    .bph-btn-reply:hover { background:#DBEAFE; color:#1D4ED8; }
    .bph-btn-hapus { background:#FEF2F2; color:#DC2626; border:1.5px solid #FECACA; }
    .bph-btn-hapus:hover { background:#FEE2E2; color:#B91C1C; }

    .bph-empty { text-align:center; padding:48px; color:#94A3B8; }
    .bph-empty i { font-size:2.5rem; display:block; margin-bottom:12px; color:#F97316; }
    .bph-empty p { font-size:0.95rem; margin:0; }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Pesan Masuk</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Kontak</span>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="bph-alert-success">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
@endif

<div class="bph-inbox-card">
    <div class="bph-inbox-head">
        <h3><i class="bi bi-inbox-fill"></i> Pesan Masuk</h3>
    </div>

    @forelse ($kontaks as $kontak)
        <div class="bph-msg-item">
            <div class="bph-msg-subject"><i class="bi bi-chat-text-fill"></i> {{ $kontak->subjek }}</div>
            <div class="bph-msg-meta"><strong>Dari:</strong> {{ $kontak->nama }} &nbsp;|&nbsp; <strong>Email:</strong> {{ $kontak->email }}</div>
            <div class="bph-msg-meta"><strong>Tanggal:</strong> {{ $kontak->created_at->format('d/m/Y H:i') }}</div>
            <div class="bph-msg-body"><strong>Isi Pesan:</strong><br>{{ $kontak->pesan }}</div>
            <div class="bph-msg-actions">
                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $kontak->email }}&su={{ urlencode('Menanggapi atas pesan yang anda kirimkan pada kami: Bio Pharm Apotek') }}"
                   target="_blank" class="bph-btn bph-btn-reply">
                    <i class="bi bi-reply-fill"></i> Balas
                </a>
                <button type="button" class="bph-btn bph-btn-hapus bph-btn-hapus-trigger" data-id="{{ $kontak->id }}">
                    <i class="bi bi-trash3-fill"></i> Hapus
                </button>
                <form id="form-hapus-{{ $kontak->id }}" action="{{ route('kontak.destroy', $kontak->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    @empty
        <div class="bph-empty">
            <i class="bi bi-inbox"></i>
            <p>Tidak ada pesan yang masuk.</p>
        </div>
    @endforelse
</div>

<script>
    document.querySelectorAll('.bph-btn-hapus-trigger').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Yakin ingin menghapus pesan ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#F97316',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-hapus-' + id).submit();
                }
            });
        });
    });
</script>
@endsection
