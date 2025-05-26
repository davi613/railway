@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<div class="container-fluid pt-4 px-4">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary"><i class="fas fa-cash-register me-2"></i>Daftar Kasir Penjualan Obat</h3>
    <a href="{{ route('jual.create') }}" class="btn btn-success me-2">
      <i class="fas fa-plus me-1"></i> Tambah Penjualan
    </a>
  </div>

  <table class="table table-striped table-hover align-middle">
    <thead>
      <tr class="bg-light">
        <th><input type="checkbox" id="check-all"></th>
        <th>Obat</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Subtotal</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($juals as $jual)
      <tr>
        <td><input type="checkbox" class="check-item" value="{{ $jual->id }}"></td>
        <td>{{ $jual->obat->nama_obat }}</td>
        <td>{{ $jual->jumlah }}</td>
        <td>Rp {{ number_format($jual->harga, 2, ',', '.') }}</td>
        <td>Rp {{ number_format($jual->subtotal, 2, ',', '.') }}</td>
        <td>{{ $jual->created_at->format('d-m-Y H:i') }}</td>
        <td>
          <a href="{{ route('jual.edit', $jual) }}" class="btn btn-sm btn-primary me-1">
            <i class="fas fa-edit"></i>
          </a>
          <form action="{{ route('jual.destroy', $jual) }}" method="POST" class="d-inline delete-form">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-sm btn-danger btn-delete">
              <i class="fas fa-trash-alt"></i>
            </button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center">Belum ada data penjualan.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
      const form = this.closest('.delete-form');
      Swal.fire({
        title: 'Yakin ingin dihapus?',
        text: "Data penjualan akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
</script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endsection
