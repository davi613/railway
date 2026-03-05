@extends('be.master')
@section('sidebar') @include('be.sidebar') @endsection
@section('navbar') @include('be.navbar') @endsection

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
    .bph-page-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:28px; flex-wrap:wrap; gap:12px; }
    .bph-page-title { font-size:1.55rem; font-weight:800; color:#1A1A2E; margin:0 0 4px 0; }
    .bph-breadcrumb { font-size:0.82rem; color:#8A8FA8; display:flex; align-items:center; gap:6px; }
    .bph-breadcrumb a { color:#F97316; text-decoration:none; font-weight:600; }
    .bph-breadcrumb .sep { color:#CBD5E1; }

    .bph-pos-card { background:#fff; border-radius:18px; box-shadow:0 4px 24px rgba(30,30,60,0.08); border:1.5px solid #F1F5F9; overflow:hidden; margin-bottom:28px; }
    .bph-pos-head { padding:20px 28px; background:linear-gradient(90deg,#1A1A2E,#2D2D4E); display:flex; align-items:center; gap:10px; }
    .bph-pos-head h3 { margin:0; font-size:1.1rem; font-weight:700; color:#F97316; display:flex; align-items:center; gap:8px; }
    .bph-pos-body { padding:24px 28px; background:#FAFAFA; }

    .bph-pos-table-scroll { overflow-x:auto; }
    .bph-pos-table { width:100%; border-collapse:separate; border-spacing:0; font-size:0.875rem; }

    .bph-pos-table thead tr { background:linear-gradient(90deg,#2D2D4E,#1A1A2E); }
    .bph-pos-table thead th { padding:12px 14px; font-size:0.78rem; font-weight:700; color:#F97316; text-transform:uppercase; letter-spacing:0.5px; border:none; text-align:center; }

    .bph-pos-table tfoot tr { background:linear-gradient(90deg,#1A1A2E,#2D2D4E); }
    .bph-pos-table tfoot th { padding:13px 14px; color:#fff; border:none; }
    .bph-pos-table tfoot th:first-child { text-align:right; font-size:0.9rem; font-weight:700; padding-right:20px; }

    .bph-pos-table .bph-item-row td { padding:10px 8px; background:#fff; border-bottom:1px solid #F1F5F9; vertical-align:middle; }
    .bph-pos-table .bph-item-row:hover td { background:#FFF7ED; }

    .bph-pos-select { width:100%; padding:9px 12px; border-radius:9px; border:1.5px solid #E2E8F0; font-size:0.88rem; font-weight:600; color:#1A1A2E; background:#fff; outline:none; transition:border 0.2s; }
    .bph-pos-select:focus { border-color:#F97316; box-shadow:0 0 0 3px rgba(249,115,22,0.1); }

    .bph-pos-input { width:100%; padding:9px 12px; border-radius:9px; border:1.5px solid #E2E8F0; font-size:0.88rem; color:#1A1A2E; background:#fff; outline:none; transition:border 0.2s; box-sizing:border-box; }
    .bph-pos-input:focus { border-color:#F97316; box-shadow:0 0 0 3px rgba(249,115,22,0.1); }
    .bph-pos-input[readonly] { background:#F1F5F9; color:#64748B; cursor:not-allowed; }

    .bph-btn { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:9px; font-size:0.85rem; font-weight:700; border:none; cursor:pointer; text-decoration:none; transition:all 0.2s; }
    .bph-btn:hover { transform:translateY(-1px); }
    .bph-btn-add { background:linear-gradient(135deg,#16A34A,#4ADE80); color:#fff; padding:7px 14px; border-radius:8px; font-size:0.82rem; }
    .bph-btn-add:hover { background:linear-gradient(135deg,#15803D,#16A34A); color:#fff; }
    .bph-btn-remove { background:#EF4444; color:#fff; padding:7px 12px; border-radius:8px; font-size:0.82rem; }
    .bph-btn-remove:hover { background:#DC2626; color:#fff; }
    .bph-btn-checkout { background:linear-gradient(135deg,#F97316,#FDBA74); color:#fff; padding:11px 28px; border-radius:11px; font-size:0.95rem; font-weight:700; box-shadow:0 4px 14px rgba(249,115,22,0.3); }
    .bph-btn-checkout:hover { background:linear-gradient(135deg,#EA6C0A,#F97316); color:#fff; }

    .bph-pos-total-input { background:#fff !important; border:1.5px solid #F97316 !important; font-weight:800; font-size:0.95rem; color:#F97316 !important; text-align:right; padding:10px 14px; border-radius:10px; }

    .bph-pos-footer { display:flex; justify-content:flex-end; gap:12px; margin-top:20px; }

    @media (max-width:640px) {
        .bph-pos-body { padding:16px; }
        .bph-pos-footer { flex-direction:column; }
        .bph-btn-checkout { width:100%; justify-content:center; }
    }
</style>

<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Kasir Penjualan</h1>
        <div class="bph-breadcrumb">
            <i class="bi bi-house-fill"></i>
            <a href="#">Dashboard</a>
            <span class="sep">/</span>
            <span>Kasir</span>
            <span class="sep">/</span>
            <span>Transaksi</span>
        </div>
    </div>
</div>

<div class="bph-pos-card">
    <div class="bph-pos-head">
        <h3><i class="bi bi-cash-register"></i> Input Transaksi Penjualan</h3>
    </div>
    <div class="bph-pos-body">
        <form action="{{ route('jual.store') }}" method="POST">
            @csrf
            <div class="bph-pos-table-scroll">
                <table class="bph-pos-table" id="bph-bulk-table">
                    <thead>
                        <tr>
                            <th>Obat</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                            <th>
                                <button type="button" class="bph-btn bph-btn-add" id="bph-add-row">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bph-item-row">
                            <td style="min-width:200px;">
                                <select name="id_obat[]" class="bph-pos-select" required>
                                    <option value="">-- Pilih Obat --</option>
                                    @foreach($obat as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td style="min-width:110px;">
                                <input type="number" name="jumlah[]" class="bph-pos-input bph-jumlah" required min="1" placeholder="0">
                            </td>
                            <td style="min-width:140px;">
                                <input type="number" name="harga[]" class="bph-pos-input bph-harga" required min="0" step="0.01" placeholder="0.00">
                            </td>
                            <td style="min-width:160px;">
                                <input type="text" class="bph-pos-input bph-subtotal" value="Rp 0" readonly>
                            </td>
                            <td style="width:60px; text-align:center;">
                                <button type="button" class="bph-btn bph-btn-remove bph-remove-row"><i class="bi bi-dash-lg"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" style="text-align:right; font-size:0.9rem; font-weight:700; padding-right:20px; color:#FDBA74;">Nominal Total Belanja:</th>
                            <th colspan="2">
                                <input type="text" id="bph-grand-total" class="bph-pos-input bph-pos-total-input" value="Rp 0" readonly>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="bph-pos-footer">
                <button type="submit" class="bph-btn bph-btn-checkout">
                    <i class="bi bi-bag-check-fill"></i> Checkout
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function bphParseRp(str) {
        return Number(str.replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(/,/, '.')) || 0;
    }

    function bphRecalc(el) {
        const tr = el.closest('tr');
        const jumlah = parseFloat(tr.querySelector('.bph-jumlah').value) || 0;
        const harga  = parseFloat(tr.querySelector('.bph-harga').value) || 0;
        const sub = jumlah * harga;
        tr.querySelector('.bph-subtotal').value = "Rp " + sub.toLocaleString('id-ID', { minimumFractionDigits: 2 });
        bphUpdateGrandTotal();
    }

    function bphUpdateGrandTotal() {
        let total = 0;
        document.querySelectorAll('.bph-subtotal').forEach(inp => { total += bphParseRp(inp.value); });
        document.getElementById('bph-grand-total').value = "Rp " + total.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    }

    function bphInitListeners(row) {
        row.querySelectorAll('.bph-jumlah, .bph-harga').forEach(el => {
            el.addEventListener('input', () => bphRecalc(el));
        });
    }

    document.getElementById('bph-add-row').addEventListener('click', function () {
        const tbody = document.querySelector('#bph-bulk-table tbody');
        const newRow = tbody.querySelector('tr').cloneNode(true);
        newRow.querySelectorAll('select, input').forEach(el => {
            if (el.tagName === 'SELECT') el.selectedIndex = 0;
            else if (el.classList.contains('bph-subtotal')) el.value = 'Rp 0';
            else el.value = '';
        });
        tbody.appendChild(newRow);
        bphInitListeners(newRow);
        bphUpdateGrandTotal();
    });

    document.querySelector('#bph-bulk-table').addEventListener('click', function (e) {
        if (e.target.closest('.bph-remove-row')) {
            const rows = document.querySelectorAll('.bph-item-row');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                bphUpdateGrandTotal();
            }
        }
    });

    document.querySelectorAll('.bph-item-row').forEach(bphInitListeners);
    bphUpdateGrandTotal();
</script>

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#F97316',
        confirmButtonText: 'OK'
    });
</script>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
