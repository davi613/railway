<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item navbar-brand-mini-wrapper">
            <a class="nav-link navbar-brand brand-logo-mini" href="#">
                <img src="{{ asset('back-end/images/logo-mini.svg') }}" alt="logo" />
            </a>
        </li>

        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="profile-image">
                    @if ($title === 'Admin')
                        <img class="img-xs rounded-circle" src="{{ asset('back-end/pht/admin.jpg') }}" alt="profile image">
                    @elseif ($title === 'Apoteker')
                        <img class="img-xs rounded-circle" src="{{ asset('back-end/pht/apoteker.jpg') }}" alt="profile image">
                    @elseif ($title === 'Karyawan')
                        <img class="img-xs rounded-circle" src="{{ asset('back-end/pht/karyawan.jpg') }}" alt="profile image">
                    @elseif ($title === 'Kasir')
                        <img class="img-xs rounded-circle" src="{{ asset('back-end/pht/kasir.jpg') }}" alt="profile image">
                    @else
                        <img class="img-xs rounded-circle" src="{{ asset('back-end/pht/owner.jpg') }}" alt="profile image">
                    @endif

                    <div class="text-wrapper">
                        <p class="mb-1 mt-3">{{ Auth::user()->name }}</p>
                        <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </a>
        </li>

        @if ($title === 'Admin')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-grid menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span class="menu-title">Hak Akses Users</span>
                    <i class="icon-key menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('costumer.index') }}">
                    <span class="menu-title">User Pelanggan</span>
                    <i class="icon-people menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('distributor.index') }}">
                    <span class="menu-title">Distributor List</span>
                    <i class="icon-briefcase menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('metode_bayar.index') }}">
                    <span class="menu-title">Jenis Pembayaran</span>
                    <i class="icon-credit-card menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis_pengiriman.index') }}">
                    <span class="menu-title">Jenis Pengiriman</span>
                    <i class="icon-cursor menu-icon"></i>
                </a>
            </li>

        @elseif ($title === 'Karyawan')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('karyawan.index') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-speedometer menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('penjualan.index') }}">
                    <span class="menu-title">Daftar Paket</span>
                    <i class="icon-basket menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pengiriman.index') }}">
                    <span class="menu-title">Tambah Pengiriman</span>
                    <i class="icon-cursor menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kontak.index') }}">
                    <span class="menu-title">Pesan Masuk</span>
                    <i class="icon-envelope menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('stok_obat.index') }}">
                    <span class="menu-title">Stok Obat</span>
                    <i class="icon-plus menu-icon"></i>
                </a>
            </li>

        @elseif ($title === 'Kasir')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kasir.index') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-home menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('jual.create') }}">
                    <span class="menu-title">Kasir Penjualan</span>
                    <i class="icon-wallet menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('konfirmasi.index') }}">
                    <span class="menu-title">Konfirmasi Paket</span>
                    <i class="icon-basket menu-icon"></i>
                </a>
            </li>

        @elseif ($title === 'Apoteker')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('apoteker.index') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-grid menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('obat.index') }}">
                    <span class="menu-title">Penambahan Obat</span>
                    <i class="icon-plus menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('jenis_obat.index') }}">
                    <span class="menu-title">Jenis Obat</span>
                    <i class="icon-list menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pembelian.index') }}">
                    <span class="menu-title">Pembelian Obat</span>
                    <i class="icon-bag menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('detail_pembelian.index') }}">
                    <span class="menu-title">Detail Pembelian Obat</span>
                    <i class="icon-note menu-icon"></i>
                </a>
            </li>

        @else {{-- Pemilik --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pemilik.index') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="icon-grid menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report.index') }}">
                    <span class="menu-title">Report</span>
                    <i class="icon-doc menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan-jual.index') }}">
                    <span class="menu-title">Laporan Penjualan</span>
                    <i class="icon-chart menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan-beli.index') }}">
                    <span class="menu-title">Laporan Pembelian</span>
                    <i class="icon-briefcase menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan_kasir.index') }}">
                    <span class="menu-title">Laporan Kasir</span>
                    <i class="icon-note menu-icon"></i>
                </a>
            </li>
        @endif
    </ul>
</nav>
