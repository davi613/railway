<nav class="bph-sidebar" id="bphSidebar">

    <!-- Brand -->
    <a class="bph-sidebar-brand" href="#">
        <div class="bph-brand-icon">
            <i class="bi bi-capsule-pill"></i>
        </div>
        <div class="bph-brand-text">
            <div class="t1">BioPharm</div>
            <div class="t2">Admin Panel</div>
        </div>
    </a>

    <!-- Profile -->
    <div class="bph-sidebar-profile">
        @if ($title === 'Admin')
            <img class="bph-sidebar-avatar" src="{{ asset('back-end/pht/admin.jpg') }}" alt="avatar">
        @elseif ($title === 'Apoteker')
            <img class="bph-sidebar-avatar" src="{{ asset('back-end/pht/apoteker.jpg') }}" alt="avatar">
        @elseif ($title === 'Karyawan')
            <img class="bph-sidebar-avatar" src="{{ asset('back-end/pht/karyawan.jpg') }}" alt="avatar">
        @elseif ($title === 'Kasir')
            <img class="bph-sidebar-avatar" src="{{ asset('back-end/pht/kasir.jpg') }}" alt="avatar">
        @else
            <img class="bph-sidebar-avatar" src="{{ asset('back-end/pht/owner.jpg') }}" alt="avatar">
        @endif

        <div style="min-width:0; flex:1;">
            <div class="bph-sidebar-uname">{{ Auth::user()->name }}</div>
            <div class="bph-sidebar-role">{{ Auth::user()->email }}</div>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="bph-sidebar-logout-btn">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Nav Items -->
    <div class="bph-nav-scroll">
        <div class="bph-nav-section-label">Navigasi</div>
        <ul class="bph-nav-list">

            @if ($title === 'Admin')
                <li>
                    <a class="bph-nav-link" href="{{ route('admin.index') }}">
                        <i class="bi bi-speedometer2 bph-nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('users.index') }}">
                        <i class="bi bi-shield-lock bph-nav-icon"></i>
                        <span>Hak Akses Users</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('costumer.index') }}">
                        <i class="bi bi-people bph-nav-icon"></i>
                        <span>User Pelanggan</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('distributor.index') }}">
                        <i class="bi bi-truck bph-nav-icon"></i>
                        <span>Distributor List</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('metode_bayar.index') }}">
                        <i class="bi bi-credit-card-2-front bph-nav-icon"></i>
                        <span>Jenis Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('jenis_pengiriman.index') }}">
                        <i class="bi bi-send bph-nav-icon"></i>
                        <span>Jenis Pengiriman</span>
                    </a>
                </li>

            @elseif ($title === 'Karyawan')
                <li>
                    <a class="bph-nav-link" href="{{ route('karyawan.index') }}">
                        <i class="bi bi-speedometer2 bph-nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('penjualan.index') }}">
                        <i class="bi bi-bag-check bph-nav-icon"></i>
                        <span>Daftar Paket</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('pengiriman.index') }}">
                        <i class="bi bi-send bph-nav-icon"></i>
                        <span>Tambah Pengiriman</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('kontak.index') }}">
                        <i class="bi bi-envelope-open bph-nav-icon"></i>
                        <span>Pesan Masuk</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('stok_obat.index') }}">
                        <i class="bi bi-capsule bph-nav-icon"></i>
                        <span>Stok Obat</span>
                    </a>
                </li>

            @elseif ($title === 'Kasir')
                <li>
                    <a class="bph-nav-link" href="{{ route('kasir.index') }}">
                        <i class="bi bi-speedometer2 bph-nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('jual.create') }}">
                        <i class="bi bi-cash-register bph-nav-icon"></i>
                        <span>Kasir Penjualan</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('konfirmasi.index') }}">
                        <i class="bi bi-bag-check bph-nav-icon"></i>
                        <span>Konfirmasi Paket</span>
                    </a>
                </li>

            @elseif ($title === 'Apoteker')
                <li>
                    <a class="bph-nav-link" href="{{ route('apoteker.index') }}">
                        <i class="bi bi-speedometer2 bph-nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('obat.index') }}">
                        <i class="bi bi-plus-circle bph-nav-icon"></i>
                        <span>Penambahan Obat</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('jenis_obat.index') }}">
                        <i class="bi bi-list-ul bph-nav-icon"></i>
                        <span>Jenis Obat</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('pembelian.index') }}">
                        <i class="bi bi-cart3 bph-nav-icon"></i>
                        <span>Pembelian Obat</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('detail_pembelian.index') }}">
                        <i class="bi bi-file-earmark-text bph-nav-icon"></i>
                        <span>Detail Pembelian</span>
                    </a>
                </li>

            @else {{-- Pemilik --}}
                <li>
                    <a class="bph-nav-link" href="{{ route('pemilik.index') }}">
                        <i class="bi bi-speedometer2 bph-nav-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('report.index') }}">
                        <i class="bi bi-file-earmark-bar-graph bph-nav-icon"></i>
                        <span>Report</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('laporan-jual.index') }}">
                        <i class="bi bi-graph-up-arrow bph-nav-icon"></i>
                        <span>Laporan Penjualan</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('laporan-beli.index') }}">
                        <i class="bi bi-graph-down-arrow bph-nav-icon"></i>
                        <span>Laporan Pembelian</span>
                    </a>
                </li>
                <li>
                    <a class="bph-nav-link" href="{{ route('laporan_kasir.index') }}">
                        <i class="bi bi-receipt bph-nav-icon"></i>
                        <span>Laporan Kasir</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>

    <div class="bph-sidebar-footer">
        BioPharm &copy; {{ date('Y') }}
    </div>
</nav>
