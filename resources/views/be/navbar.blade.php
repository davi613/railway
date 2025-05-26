    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" >
                <h3 style="color:white;" >Bio</h3>
                <h3 style="color:orange; margin-top: -20px;" >Pharm</h3>
                <img src="{{ asset ('back-end/images/logo-light.svg') }}" alt="logo-light" class="logo-light">
            </a>
            <a class="navbar-brand brand-logo-mini" ><img src="{{ asset ('back-end/images/logo-mini.svg') }}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
            <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome Apotek Dashboard!</h5>
            <ul class="navbar-nav navbar-nav-right">
                {{-- <form class="search-form d-none d-md-block" action="#"> --}}
                {{-- <i class="icon-magnifier"></i> --}}
                {{-- <input type="search" class="form-control" placeholder="Search Here" title="Search here"> --}}
                {{-- </form> --}}
                
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
    <a class="nav-link dropdown-toggle d-flex align-items-center" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">

        @if ($title === 'Admin')
            <img class="img-xs rounded-circle ms-2" src="{{ asset('back-end/pht/admin.jpg') }}" alt="Profile image">
            <span class="font-weight-normal ms-2" style="color: #ff6600;">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">
            <img class="img-md rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('back-end/pht/admin.jpg') }}" alt="Profile image">
            <p class="mb-1 mt-3" style="color: #ff6600;">{{ Auth::user()->name }}</p>
            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
        </div>

        @elseif ($title === 'Apoteker')
            <img class="img-xs rounded-circle ms-2" src="{{ asset('back-end/pht/apoteker.jpg') }}" alt="Profile image">
            <span class="font-weight-normal ms-2" style="color: #ff6600;">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">
            <img class="img-md rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('back-end/pht/apoteker.jpg') }}" alt="Profile image">
            <p class="mb-1 mt-3" style="color: #ff6600;">{{ Auth::user()->name }}</p>
            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
        </div>

        @elseif ($title === 'Karyawan')
            <img class="img-xs rounded-circle ms-2" src="{{ asset('back-end/pht/karyawan.jpg') }}" alt="Profile image">
            <span class="font-weight-normal ms-2" style="color: #ff6600;">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">
            <img class="img-md rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('back-end/pht/karyawan.jpg') }}" alt="Profile image">
            <p class="mb-1 mt-3" style="color: #ff6600;">{{ Auth::user()->name }}</p>
            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
        </div>

        @elseif ($title === 'Kasir')
            <img class="img-xs rounded-circle ms-2" src="{{ asset('back-end/pht/kasir.jpg') }}" alt="Profile image">
            <span class="font-weight-normal ms-2" style="color: #ff6600;">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">
            <img class="img-md rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('back-end/pht/kasir.jpg') }}" alt="Profile image">
            <p class="mb-1 mt-3" style="color: #ff6600;">{{ Auth::user()->name }}</p>
            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
        </div>

        @else {{-- Pemilik --}}
            <img class="img-xs rounded-circle ms-2" src="{{ asset('back-end/pht/owner.jpg') }}" alt="Profile image">
            <span class="font-weight-normal ms-2" style="color: #ff6600;">{{ Auth::user()->name }}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
        <div class="dropdown-header text-center">
            <img class="img-md rounded-circle mb-3" style="width: 70px; height: 70px; object-fit: cover;" src="{{ asset('back-end/pht/owner.jpg') }}" alt="Profile image">
            <p class="mb-1 mt-3" style="color: #ff6600;">{{ Auth::user()->name }}</p>
            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
        </div>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="px-3 pb-3">
            @csrf
            <button type="submit" class="btn btn-warning w-100" style="color: white; font-weight: 600;background-color:orange;">Logout</button>
        </form>
    </div>
</li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
            </div>
        </nav>