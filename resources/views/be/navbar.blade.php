<nav class="bph-navbar" id="bphNavbar">

    <!-- Toggle Button -->
    <button class="bph-navbar-toggle" id="bphToggle" title="Toggle Sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Mobile Brand -->
    <a class="bph-mobile-brand" href="#">
        <span class="t1">Bio<span class="t2">Pharm</span></span>
    </a>

    <!-- Welcome Text -->
    <span class="bph-navbar-welcome">
        Selamat Datang, <span>{{ Auth::user()->name }}</span> &mdash; Apotek BioPharm
    </span>

    <!-- User Dropdown -->
    <div class="dropdown" style="margin-left:auto; flex-shrink:0;">

        @if ($title === 'Admin')
            <a class="bph-user-pill" href="#" id="bphUserDrop" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="bph-user-pill-avatar" src="{{ asset('back-end/pht/admin.jpg') }}" alt="avatar">
                <span class="bph-user-pill-name">{{ Auth::user()->name }}</span>
                <i class="bi bi-chevron-down bph-user-pill-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bph-dropdown-menu" aria-labelledby="bphUserDrop">
                <div class="bph-dropdown-head">
                    <img src="{{ asset('back-end/pht/admin.jpg') }}" alt="avatar">
                    <div class="dn">{{ Auth::user()->name }}</div>
                    <div class="de">{{ Auth::user()->email }}</div>
                </div>
                <div class="bph-dropdown-body">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bph-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        @elseif ($title === 'Apoteker')
            <a class="bph-user-pill" href="#" id="bphUserDrop" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="bph-user-pill-avatar" src="{{ asset('back-end/pht/apoteker.jpg') }}" alt="avatar">
                <span class="bph-user-pill-name">{{ Auth::user()->name }}</span>
                <i class="bi bi-chevron-down bph-user-pill-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bph-dropdown-menu" aria-labelledby="bphUserDrop">
                <div class="bph-dropdown-head">
                    <img src="{{ asset('back-end/pht/apoteker.jpg') }}" alt="avatar">
                    <div class="dn">{{ Auth::user()->name }}</div>
                    <div class="de">{{ Auth::user()->email }}</div>
                </div>
                <div class="bph-dropdown-body">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bph-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        @elseif ($title === 'Karyawan')
            <a class="bph-user-pill" href="#" id="bphUserDrop" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="bph-user-pill-avatar" src="{{ asset('back-end/pht/karyawan.jpg') }}" alt="avatar">
                <span class="bph-user-pill-name">{{ Auth::user()->name }}</span>
                <i class="bi bi-chevron-down bph-user-pill-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bph-dropdown-menu" aria-labelledby="bphUserDrop">
                <div class="bph-dropdown-head">
                    <img src="{{ asset('back-end/pht/karyawan.jpg') }}" alt="avatar">
                    <div class="dn">{{ Auth::user()->name }}</div>
                    <div class="de">{{ Auth::user()->email }}</div>
                </div>
                <div class="bph-dropdown-body">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bph-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        @elseif ($title === 'Kasir')
            <a class="bph-user-pill" href="#" id="bphUserDrop" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="bph-user-pill-avatar" src="{{ asset('back-end/pht/kasir.jpg') }}" alt="avatar">
                <span class="bph-user-pill-name">{{ Auth::user()->name }}</span>
                <i class="bi bi-chevron-down bph-user-pill-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bph-dropdown-menu" aria-labelledby="bphUserDrop">
                <div class="bph-dropdown-head">
                    <img src="{{ asset('back-end/pht/kasir.jpg') }}" alt="avatar">
                    <div class="dn">{{ Auth::user()->name }}</div>
                    <div class="de">{{ Auth::user()->email }}</div>
                </div>
                <div class="bph-dropdown-body">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bph-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

        @else {{-- Pemilik --}}
            <a class="bph-user-pill" href="#" id="bphUserDrop" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="bph-user-pill-avatar" src="{{ asset('back-end/pht/owner.jpg') }}" alt="avatar">
                <span class="bph-user-pill-name">{{ Auth::user()->name }}</span>
                <i class="bi bi-chevron-down bph-user-pill-chevron"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end bph-dropdown-menu" aria-labelledby="bphUserDrop">
                <div class="bph-dropdown-head">
                    <img src="{{ asset('back-end/pht/owner.jpg') }}" alt="avatar">
                    <div class="dn">{{ Auth::user()->name }}</div>
                    <div class="de">{{ Auth::user()->email }}</div>
                </div>
                <div class="bph-dropdown-body">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bph-logout-btn">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @endif

    </div>
</nav>
