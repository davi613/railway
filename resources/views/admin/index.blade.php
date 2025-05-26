@extends('be.master')

@section('navbar')
    @include('be.navbar')
@endsection

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row g-4 mb-4">

        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white shadow" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); border-radius: 15px;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-bold">Total Users</h6>
                        <h2 class="mb-0">{{ $totalUsers }}</h2>
                    </div>
                    <div class="icon" style="font-size: 2.5rem;">👥</div>
                </div>
            </div>
        </div>

        <!-- Current Active User -->
        <div class="col-xl-3 col-md-6">
            <div class="card text-white shadow" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); border-radius: 15px;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase fw-bold">Active User</h6>
                        <p class="mb-0 fs-5">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="icon" style="font-size: 2.5rem;">🧑‍💼</div>
                </div>
            </div>
        </div>

        <!-- Quick Action -->

        <div class="col-xl-3 col-md-6">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <h6 class="text-uppercase fw-bold mb-3">Download Report</h6>
                    <a href="{{ route('laporan.admin.pdf') }}" class="btn btn-success w-100">
                        📄 Download PDF
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-body">
                    <h6 class="text-uppercase fw-bold mb-3">Quick Action</h6>
                    <a href="{{ route('users.create') }}" class="btn btn-info text-white w-100">
                        ➕ Add New User
                    </a>
                </div>
            </div>
        </div>

        <!-- PDF Report -->
    </div>

    <!-- System Summary / Alternative Info Box -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fw-bold mb-3">System Summary</h5>
                        <ul class="list-unstyled">
                            <li>📡 Status Server: <span class="badge bg-success">Online</span></li>
                            <li>🕒 Total Waktu Aktif Server (Per Tanggal Sekarang): <strong>{{ now()->format('H:i:s') }}</strong></li>
                        </ul>
                    </div>
                    <div class="text-end">
                        <img src="https://img.icons8.com/3d-fluency/100/monitor.png" width="80" alt="monitor" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
