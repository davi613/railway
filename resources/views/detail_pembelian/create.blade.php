@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection
@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="row mb-5">
                    <div class="col-auto me-auto mb-4 h3 text-black-50">Detail Pembelian Create</div>
                    <h4>Data akan muncul ketika data pembelian dibuat</h4>
                </div>

                <form action="{{ route('detail_pembelian.store') }}" method="POST" id="detailForm">
                    @csrf
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="id_pembelian" class="form-label">Pembelian</label>
                            <select style="color:black;" class="form-select" id="id_pembelian" name="id_pembelian" required>
                                <option value="">Pilih Nota Pembelian</option>
                                @foreach ($pembelians as $pembelian)
                                    <option value="{{ $pembelian->id }}">
                                        {{ $pembelian->nonota }} - {{ date('d/m/Y', strtotime($pembelian->tgl_pembelian)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_obat" class="form-label">Obat</label>
                            <select style="color:black;" class="form-select" id="id_obat" name="id_obat" required>
                                <option value="">Pilih Obat</option>
                                @foreach ($obats as $obat)
                                    <option value="{{ $obat->id }}" data-harga="{{ $obat->harga_jual }}">
                                        {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="jumlah_beli" class="form-label">Jumlah Beli</label>
                            <input type="number" class="form-control" id="jumlah_beli" name="jumlah_beli" min="1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" class="form-control" id="harga_beli" name="harga_beli" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label for="subtotal" class="form-label">Subtotal</label>
                            <input type="number" class="form-control" id="subtotal" name="subtotal" step="0.01" min="0" readonly>
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

    // Hapus autofill harga beli ketika obat dipilih
    obatSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            // Tidak lagi mengisi harga otomatis di sini
            calculateSubtotal();
        }
    });

    // Hitung subtotal ketika jumlah atau harga beli berubah
    jumlahBeli.addEventListener('input', calculateSubtotal);
    hargaBeli.addEventListener('input', calculateSubtotal);

    function calculateSubtotal() {
        const jumlah = parseFloat(jumlahBeli.value) || 0;
        const harga = parseFloat(hargaBeli.value) || 0;
        subtotal.value = (jumlah * harga).toFixed(2);
    }
});
</script>
@endsection
