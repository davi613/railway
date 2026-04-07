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

    /* Searchable select wrapper */
    .bph-searchable-wrap { position:relative; width:100%; min-width:200px; }
    .bph-search-input { width:100%; padding:9px 12px; border-radius:9px; border:1.5px solid #E2E8F0; font-size:0.88rem; font-weight:600; color:#1A1A2E; background:#fff; outline:none; transition:border 0.2s; box-sizing:border-box; }
    .bph-search-input:focus { border-color:#F97316; box-shadow:0 0 0 3px rgba(249,115,22,0.1); }
    .bph-dropdown-list { position:absolute; top:calc(100% + 4px); left:0; right:0; background:#fff; border:1.5px solid #F97316; border-radius:9px; max-height:200px; overflow-y:auto; z-index:9999; display:none; box-shadow:0 8px 24px rgba(249,115,22,0.15); }
    .bph-dropdown-list.show { display:block; }
    .bph-dropdown-item { padding:9px 12px; font-size:0.88rem; color:#1A1A2E; cursor:pointer; transition:background 0.15s; }
    .bph-dropdown-item:hover { background:#FFF7ED; color:#F97316; font-weight:600; }
    .bph-dropdown-item.no-result { color:#94A3B8; cursor:default; font-style:italic; }
    .bph-dropdown-item.no-result:hover { background:#fff; color:#94A3B8; font-weight:400; }
    /* hidden real select */
    .bph-pos-select-hidden { display:none; }

    /* stok tersedia input */
    .bph-stok-input { background:#F1F5F9 !important; color:#64748B !important; cursor:not-allowed; text-align:center; font-weight:700; }

    /* jumlah error */
    .bph-jumlah-error { color:#EF4444; font-size:0.75rem; font-weight:600; margin-top:4px; display:none; }

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

{{-- Data stok obat untuk JavaScript --}}
<script>
    const bphObatData = {!! json_encode($obat->map(fn($o) => ['id' => $o->id, 'nama' => $o->nama_obat, 'stok' => $o->stok, 'harga' => $o->harga_jual])) !!};
</script>

<div class="bph-pos-card">
    <div class="bph-pos-head">
        <h3><i class="bi bi-cash-register"></i> Input Transaksi Penjualan</h3>
    </div>
    <div class="bph-pos-body">
        <form action="{{ route('jual.store') }}" method="POST" id="bph-form">
            @csrf
            <div class="bph-pos-table-scroll">
                <table class="bph-pos-table" id="bph-bulk-table">
                    <thead>
                        <tr>
                            <th>Obat</th>
                            <th>Stok Tersedia</th>
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
                            {{-- Kolom Obat: Searchable --}}
                            <td style="min-width:220px;">
                                <div class="bph-searchable-wrap">
                                    <input type="text" class="bph-search-input bph-obat-search" placeholder="-- Cari / Pilih Obat --" autocomplete="off">
                                    <div class="bph-dropdown-list"></div>
                                    <select name="id_obat[]" class="bph-pos-select-hidden bph-pos-select" required>
                                        <option value="">-- Pilih Obat --</option>
                                        @foreach($obat as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            {{-- Kolom Stok Tersedia: Readonly, auto --}}
                            <td style="min-width:110px;">
                                <input type="text" class="bph-pos-input bph-stok-input bph-stok" value="-" readonly>
                            </td>
                            {{-- Kolom Jumlah + validasi --}}
                            <td style="min-width:110px;">
                                <input type="number" name="jumlah[]" class="bph-pos-input bph-jumlah" required min="1" placeholder="0">
                                <div class="bph-jumlah-error">Jumlah tidak boleh melebihi stok tersedia!</div>
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
                            <th colspan="4" style="text-align:right; font-size:0.9rem; font-weight:700; padding-right:20px; color:#FDBA74;">Nominal Total Belanja:</th>
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
    /* ===== Utility ===== */
    function bphParseRp(str) {
        return Number(str.replace(/[^0-9.,]/g, '').replace(/\./g, '').replace(/,/, '.')) || 0;
    }

    /* ===== Recalc subtotal & grand total ===== */
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

    /* ===== Validasi jumlah vs stok ===== */
    function bphValidasiJumlah(jumlahInput) {
        const tr = jumlahInput.closest('tr');
        const stokInput = tr.querySelector('.bph-stok');
        const errorEl  = tr.querySelector('.bph-jumlah-error');
        const stokVal  = parseInt(stokInput.getAttribute('data-stok')) || 0;
        const jumlahVal = parseInt(jumlahInput.value) || 0;

        if (stokVal > 0 && jumlahVal > stokVal) {
            jumlahInput.style.borderColor = '#EF4444';
            jumlahInput.style.boxShadow = '0 0 0 3px rgba(239,68,68,0.12)';
            errorEl.style.display = 'block';
            return false;
        } else {
            jumlahInput.style.borderColor = '';
            jumlahInput.style.boxShadow = '';
            errorEl.style.display = 'none';
            return true;
        }
    }

    /* ===== Set stok tersedia saat obat dipilih ===== */
    function bphSetStok(tr, obatId) {
        const stokInput = tr.querySelector('.bph-stok');
        const jumlahInput = tr.querySelector('.bph-jumlah');
        const hargaInput = tr.querySelector('.bph-harga');

        if (!obatId) {
            stokInput.value = '-';
            stokInput.setAttribute('data-stok', '0');
            return;
        }

        const found = bphObatData.find(o => String(o.id) === String(obatId));
        if (found) {
            stokInput.value = found.stok;
            stokInput.setAttribute('data-stok', found.stok);
            // Auto-isi harga jual jika harga belum diisi
            if (!hargaInput.value) {
                hargaInput.value = found.harga;
            }
        } else {
            stokInput.value = '-';
            stokInput.setAttribute('data-stok', '0');
        }

        // Reset validasi jumlah saat obat diganti
        bphValidasiJumlah(jumlahInput);
        bphRecalc(jumlahInput);
    }

    /* ===== Inisialisasi searchable dropdown ===== */
    function bphInitSearchable(wrap) {
        const searchInput = wrap.querySelector('.bph-obat-search');
        const dropdown    = wrap.querySelector('.bph-dropdown-list');
        const hiddenSelect = wrap.querySelector('.bph-pos-select');
        const tr = wrap.closest('tr');

        // Isi dropdown dengan semua opsi
        function bphRenderDropdown(filter) {
            dropdown.innerHTML = '';
            const kata = filter.toLowerCase();
            const results = bphObatData.filter(o => o.nama.toLowerCase().includes(kata));

            if (results.length === 0) {
                const noItem = document.createElement('div');
                noItem.className = 'bph-dropdown-item no-result';
                noItem.textContent = 'Obat tidak ditemukan';
                dropdown.appendChild(noItem);
                return;
            }

            results.forEach(o => {
                const item = document.createElement('div');
                item.className = 'bph-dropdown-item';
                item.textContent = o.nama;
                item.setAttribute('data-id', o.id);
                item.addEventListener('mousedown', function (e) {
                    e.preventDefault();
                    // Set nilai hidden select
                    hiddenSelect.value = o.id;
                    // Set teks search input
                    searchInput.value = o.nama;
                    // Tutup dropdown
                    dropdown.classList.remove('show');
                    // Update stok tersedia
                    bphSetStok(tr, o.id);
                });
                dropdown.appendChild(item);
            });
        }

        // Buka dropdown saat fokus / klik
        searchInput.addEventListener('focus', function () {
            bphRenderDropdown(searchInput.value);
            dropdown.classList.add('show');
        });

        // Filter saat mengetik
        searchInput.addEventListener('input', function () {
            // Reset hidden select saat mengetik ulang
            hiddenSelect.value = '';
            bphSetStok(tr, '');
            bphRenderDropdown(searchInput.value);
            if (!dropdown.classList.contains('show')) {
                dropdown.classList.add('show');
            }
        });

        // Tutup dropdown saat blur
        searchInput.addEventListener('blur', function () {
            setTimeout(() => { dropdown.classList.remove('show'); }, 150);
        });
    }

    /* ===== Init semua listener untuk satu baris ===== */
    function bphInitListeners(row) {
        // Searchable
        const wrap = row.querySelector('.bph-searchable-wrap');
        if (wrap) bphInitSearchable(wrap);

        // Recalc saat input jumlah / harga
        row.querySelectorAll('.bph-jumlah, .bph-harga').forEach(el => {
            el.addEventListener('input', function () {
                if (el.classList.contains('bph-jumlah')) {
                    bphValidasiJumlah(el);
                }
                bphRecalc(el);
            });
        });
    }

    /* ===== Tambah baris ===== */
    document.getElementById('bph-add-row').addEventListener('click', function () {
        const tbody = document.querySelector('#bph-bulk-table tbody');
        const templateRow = tbody.querySelector('tr');
        const newRow = templateRow.cloneNode(true);

        // Reset semua input di baris baru
        newRow.querySelectorAll('input').forEach(el => {
            if (el.classList.contains('bph-subtotal')) {
                el.value = 'Rp 0';
            } else if (el.classList.contains('bph-stok-input')) {
                el.value = '-';
                el.setAttribute('data-stok', '0');
            } else if (el.classList.contains('bph-obat-search')) {
                el.value = '';
            } else {
                el.value = '';
            }
            el.style.borderColor = '';
            el.style.boxShadow = '';
        });

        // Reset hidden select
        newRow.querySelectorAll('select').forEach(el => { el.selectedIndex = 0; el.value = ''; });

        // Sembunyikan error jumlah
        const errEl = newRow.querySelector('.bph-jumlah-error');
        if (errEl) errEl.style.display = 'none';

        // Reset dropdown list
        const dl = newRow.querySelector('.bph-dropdown-list');
        if (dl) { dl.innerHTML = ''; dl.classList.remove('show'); }

        tbody.appendChild(newRow);
        bphInitListeners(newRow);
        bphUpdateGrandTotal();
    });

    /* ===== Hapus baris ===== */
    document.querySelector('#bph-bulk-table').addEventListener('click', function (e) {
        if (e.target.closest('.bph-remove-row')) {
            const rows = document.querySelectorAll('.bph-item-row');
            if (rows.length > 1) {
                e.target.closest('tr').remove();
                bphUpdateGrandTotal();
            }
        }
    });

    /* ===== Cegah submit jika ada validasi gagal ===== */
    document.getElementById('bph-form').addEventListener('submit', function (e) {
        let valid = true;
        document.querySelectorAll('.bph-jumlah').forEach(input => {
            if (!bphValidasiJumlah(input)) valid = false;
        });
        // Cek apakah semua baris sudah memilih obat
        document.querySelectorAll('.bph-pos-select').forEach(sel => {
            if (!sel.value) valid = false;
        });
        if (!valid) e.preventDefault();
    });

    /* ===== Init baris pertama ===== */
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