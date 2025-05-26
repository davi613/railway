@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Detail Pembelian Edit</div>
                </div>

                <form action="{{ route('detail_pembelian.update', $detail->id) }}" method="POST" id="detailForm">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="id_pembelian" class="form-label">No.Nota Pembelian dan tanggal</label>
                            <select style="background-color:blue;color:white;" class="form-select" id="id_pembelian_display" disabled>
                                @foreach ($pembelians as $pembelian)
                                    <option value="{{ $pembelian->id }}" {{ $detail->id_pembelian == $pembelian->id ? 'selected' : '' }}>
                                        {{ $pembelian->nonota }} - {{ date('d/m/Y', strtotime($pembelian->tgl_pembelian)) }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="id_pembelian" value="{{ $detail->id_pembelian }}">
                        </div>
                        <div class="col-md-6">
                            <label for="id_obat" class="form-label">Obat</label>
                            <select style="color:black;" class="form-select" id="id_obat" name="id_obat" required>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" 
                                        {{-- data-harga="{{ $obat->harga_jual }}" --}}
                                        {{ $detail->id_obat == $obat->id ? 'selected' : '' }}>
                                        {{ $obat->nama_obat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="jumlah_beli" class="form-label">Jumlah Beli</label>
                            <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli" 
                                value="{{ $detail->jumlah_beli }}" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" 
                                value="{{ $detail->harga_beli }}" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label for="subtotal" class="form-label">Subtotal</label>
                            <input type="number" class="form-control" id="subtotal" name="subtotal" 
                                value="{{ $detail->subtotal }}" step="0.01" min="0" readonly>
                        </div>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('detail_pembelian.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn" style="background-color: #006400; color: white;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const obatSelect = document.getElementById('id_obat');
    const jumlahBeli = document.getElementById('jumlah_beli');
    const hargaBeli = document.getElementById('harga_beli');
    const subtotal = document.getElementById('subtotal');

    // Auto-fill harga beli ketika obat dipilih
    obatSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            hargaBeli.value = selectedOption.getAttribute('data-harga');
            calculateSubtotal();
        }
    });

    // Hitung subtotal ketika jumlah atau harga berubah
    jumlahBeli.addEventListener('input', calculateSubtotal);
    hargaBeli.addEventListener('input', calculateSubtotal);

    function calculateSubtotal() {
        const jumlah = parseFloat(jumlahBeli.value) || 0;
        const harga = parseFloat(hargaBeli.value) || 0;
        subtotal.value = (jumlah * harga).toFixed(2);
    }

    // Hitung subtotal awal
    calculateSubtotal();
});
</script>
@endsection