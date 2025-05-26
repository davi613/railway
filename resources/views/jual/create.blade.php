@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<div class="container-fluid pt-4 px-4">
  <div class="row g-4 justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow-lg rounded-lg">
        {{-- Card Header: tampilan kasir profesional --}}
        <div class="card-header bg-dark text-white border-0 py-3">
          <h3 class="mb-0"><i class="fas fa-cash-register me-2"></i>Kasir Penjualan</h3>
        </div>
        <div class="card-body p-4 bg-light">
          <form action="{{ route('jual.store') }}" method="POST">
            @csrf
            <div class="table-responsive">
              <table class="table table-borderless align-middle text-center" id="bulk-table">
                <thead>
                  <tr class="bg-secondary text-white">
                    <th>Obat</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>
                      <button type="button" class="btn btn-success btn-sm shadow" id="add-row">
                        <i class="fas fa-plus"></i>
                      </button>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="item-row">
                    <td class="p-1">
                      <select name="id_obat[]" class="form-select border-dark text-black fw-medium" required>
                        <option value="">-- Pilih Obat --</option>
                        @foreach($obat as $item)
                          <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                        @endforeach
                      </select>
                    </td>
                    <td class="p-1">
                      <input type="number" name="jumlah[]" class="form-control border-dark jumlah text-center" required min="1" oninput="recalc(this)">
                    </td>
                    <td class="p-1">
                      <input type="number" name="harga[]" class="form-control border-dark harga text-end pe-2" required min="0" step="0.01" oninput="recalc(this)">
                    </td>
                    <td class="p-1">
                      <input type="text" class="form-control border-dark bg-white subtotal text-end" value="Rp 0" readonly>
                    </td>
                    <td class="p-1">
                      <button type="button" class="btn btn-danger btn-sm shadow remove-row">
                        <i class="fas fa-minus"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr class="bg-dark text-white">
                    <th colspan="3" class="text-end pe-4">Nominal Total Belanja:</th>
                    <th class="text-end">
                      <input type="text" id="grand-total" class="form-control border-dark bg-white text-end fw-bold" value="Rp 0" readonly>
                    </th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-3">
              <button type="submit" class="btn btn-primary px-4 shadow">
                <i class="fas fa-check me-1"></i> Checkout
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Script Dinamis --}}
<script>
  function parseRp(str) {
    return Number(str.replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(/,/, '.')) || 0;
  }

  function recalc(el) {
    const tr     = el.closest('tr');
    const jumlah = parseFloat(tr.querySelector('.jumlah').value) || 0;
    const harga  = parseFloat(tr.querySelector('.harga').value) || 0;
    const sub    = jumlah * harga;
    tr.querySelector('.subtotal').value = "Rp " + sub.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    updateGrandTotal();
  }

  function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(input => {
      total += parseRp(input.value);
    });
    document.getElementById('grand-total').value = "Rp " + total.toLocaleString('id-ID', { minimumFractionDigits: 2 });
  }

  function initListeners(row) {
    row.querySelectorAll('.jumlah, .harga').forEach(el => el.addEventListener('input', () => recalc(el)));
  }

  document.getElementById('add-row').addEventListener('click', function() {
    const tbody  = document.querySelector('#bulk-table tbody');
    const newRow = tbody.querySelector('tr').cloneNode(true);
    newRow.querySelectorAll('select, input').forEach(el => {
      if (el.tagName === 'SELECT') el.selectedIndex = 0;
      else if (el.classList.contains('subtotal')) el.value = 'Rp 0';
      else el.value = '';
    });
    tbody.appendChild(newRow);
    initListeners(newRow);
    updateGrandTotal();
  });

  document.querySelector('#bulk-table').addEventListener('click', function(e) {
    if (e.target.closest('.remove-row')) {
      const rows = document.querySelectorAll('.item-row');
      if (rows.length > 1) {
        e.target.closest('tr').remove();
        updateGrandTotal();
      }
    }
  });

  document.querySelectorAll('.item-row').forEach(initListeners);
  updateGrandTotal();
</script>

{{-- SweetAlert ketika berhasil --}}
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'OK'
  });
</script>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
@endsection
