@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-12">
      <div class="bg-white shadow rounded p-5">
        <h3 class="mb-4 text-primary">
          <i class="fas fa-edit me-2"></i>Edit Penjualan Obat
        </h3>

        <form action="{{ route('jual.update', $jual) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-4">
            <label for="id_obat" class="form-label fw-semibold text-dark">Pilih Obat</label>
            <select name="id_obat" id="id_obat" class="form-select border-primary" required>
              <option value="">-- Pilih Obat --</option>
              @foreach($obat as $obat)
                <option value="{{ $obat->id }}"
                  {{ old('id_obat', $jual->id_obat) == $obat->id ? 'selected' : '' }}>
                  {{ $obat->nama_obat }}
                </option>
              @endforeach
            </select>
            @error('id_obat')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="row mb-4">
            <div class="col-md-6">
              <label for="jumlah" class="form-label fw-semibold text-dark">Jumlah</label>
              <input type="number" name="jumlah" id="jumlah"
                     class="form-control border-primary"
                     required min="1"
                     value="{{ old('jumlah', $jual->jumlah) }}"
                     oninput="calculateSubtotal()">
              @error('jumlah')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>

            <div class="col-md-6">
              <label for="harga" class="form-label fw-semibold text-dark">Harga Satuan (Rp)</label>
              <input type="number" name="harga" id="harga"
                     class="form-control border-primary"
                     required min="0" step="0.01"
                     value="{{ old('harga', $jual->harga) }}"
                     oninput="calculateSubtotal()">
              @error('harga')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="mb-4">
            <label for="subtotal" class="form-label fw-semibold text-dark">Subtotal</label>
            <input type="text" id="subtotal"
                   class="form-control bg-light border-secondary"
                   value="Rp {{ number_format(old('jumlah', $jual->jumlah) * old('harga', $jual->harga), 2, ',', '.') }}"
                   readonly>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">
              <i class="fas fa-save me-1"></i> Update
            </button>
            <a href="{{ route('jual.index') }}" class="btn btn-warning text-white">
              <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Script Subtotal --}}
<script>
  function calculateSubtotal() {
    const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
    const harga  = parseFloat(document.getElementById('harga').value)  || 0;
    const subtotal = jumlah * harga;
    document.getElementById('subtotal').value =
      "Rp " + subtotal.toLocaleString('id-ID', { minimumFractionDigits: 2 });
  }
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endsection
