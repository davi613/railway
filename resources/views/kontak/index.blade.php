@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="row g-4">
        <div class="col-12">
            <div class="bg-white rounded shadow p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-primary"><i class="fas fa-inbox me-2"></i>Pesan Masuk</h3>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                @endif

                @forelse ($kontaks as $kontak)
                    <div class="border-bottom pb-3 mb-3">
                        <h5 class="fw-bold">{{ $kontak->subjek }}</h5>
                        <p class="mb-1"><strong>Dari:</strong> {{ $kontak->nama }} ({{ $kontak->email }})</p>
                        <p class="mb-1"><strong>Tanggal:</strong> {{ $kontak->created_at->format('d/m/Y H:i') }}</p>
                        <p class="mt-2"><strong>Isi Pesan:</strong><br>{{ $kontak->pesan }}</p>

                        <div class="mt-2">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $kontak->email }}&su={{ urlencode('Menanggapi atas pesan yang anda kirimkan pada kami: Bio Pharm Apotek') }}"
                               target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-reply me-1"></i> Balas
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-id="{{ $kontak->id }}">
                                <i class="fas fa-trash me-1"></i> Hapus
                            </button>
                            <form id="form-hapus-{{ $kontak->id }}" action="{{ route('kontak.destroy', $kontak->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Tidak ada pesan yang masuk.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- SweetAlert untuk konfirmasi hapus --}}
<script>
    document.querySelectorAll('.btn-hapus').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Yakin ingin menghapus pesan ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-hapus-${id}`).submit();
                }
            });
        });
    });
</script>
@endsection
