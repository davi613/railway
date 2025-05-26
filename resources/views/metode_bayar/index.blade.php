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
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-dark">
                        <i class="bi bi-credit-card-2-back me-2 text-success"></i>
                        Daftar Metode Pembayaran
                    </h5>
                    <a href="{{ route('metode_bayar.create') }}" class="btn btn-success btn-sm d-flex align-items-center">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Metode
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-light text-uppercase text-secondary">
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th><i class="bi bi-wallet2 me-1"></i>Metode</th>
                                    <th><i class="bi bi-shop me-1"></i>Tempat Bayar</th>
                                    <th><i class="bi bi-hash me-1"></i>No. Rekening</th>
                                    <th><i class="bi bi-image me-1"></i>Logo</th>
                                    <th><i class="bi bi-calendar-plus me-1"></i>Dibuat</th>
                                    <th><i class="bi bi-calendar-check me-1"></i>Diperbarui</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($metodeBayars as $no => $item)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                            <a style="background-color:orange; color:white;" href="{{ route('metode_bayar.edit', $item->id) }}" class="btn btn-outline-warning btn-sm me-1" title="Edit">
                                                <i class="bi bi-pencil-square">Edit</i>
                                            </a>
                                            <button style="background-color:red; color:white;" type="button" class="btn btn-outline-danger btn-sm" title="Hapus" onclick="confirmDelete({{ $item->id }})">
                                                <i class="bi bi-trash3">Hapus</i>
                                            </button>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('metode_bayar.destroy', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                        </td>
                                        <td>{{ $no + 1 }}</td>
                                        <td class="text-start">{{ $item->metode_pembayaran }}</td>
                                        <td>{{ $item->tempat_bayar }}</td>
                                        <td>{{ $item->no_rekening ?? '-' }}</td>
                                        <td>
                                            @if ($item->url_logo)
                                                <img src="{{ asset('storage/' . $item->url_logo) }}" alt="Logo" class="img-thumbnail rounded" style="width: 50px; cursor: pointer;" 
                                                    data-bs-toggle="modal" data-bs-target="#logoModal" 
                                                    data-logo="{{ asset('storage/' . $item->url_logo) }}" 
                                                    data-name="{{ $item->metode_pembayaran }}">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach

                                @if ($metodeBayars->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            <i class="bi bi-info-circle me-1"></i> Belum ada data metode pembayaran.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk preview gambar logo --}}
<div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="logoModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="" alt="Logo Preview" id="logoPreview" class="img-fluid rounded" style="max-height: 70vh; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

{{-- SweetAlert2 --}}
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data ini akan hilang secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Script untuk modal preview gambar logo
    var logoModal = document.getElementById('logoModal');
    logoModal.addEventListener('show.bs.modal', function (event) {
      var img = event.relatedTarget; // gambar yang diklik
      var logoSrc = img.getAttribute('data-logo');
      var metodeName = img.getAttribute('data-name');
      var modalTitle = logoModal.querySelector('.modal-title');
      var modalImage = logoModal.querySelector('#logoPreview');

      modalTitle.textContent = metodeName;
      modalImage.src = logoSrc;
      modalImage.alt = 'Logo ' + metodeName;
    });
</script>
@endsection
