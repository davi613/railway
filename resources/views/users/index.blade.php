@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')

<!-- Page Header -->
<div class="bph-page-head">
    <div>
        <h1 class="bph-page-title">Manajemen User</h1>
        <div class="bph-breadcrumb">
            <a href="{{ route('admin.index') }}"><i class="bi bi-house-fill"></i> Dashboard</a>
            <span class="sep">/</span>
            <span>Manajemen User</span>
        </div>
    </div>
    <a href="{{ route('users.create') }}" class="bph-btn bph-btn-primary">
        <i class="bi bi-person-plus-fill"></i> Tambah User
    </a>
</div>

<!-- Card -->
<div class="bph-card">
    <div class="bph-card-head">
        <div class="bph-card-title">
            <i class="bi bi-shield-lock-fill"></i>
            Daftar Akun User & Hak Akses
        </div>
        <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <div class="bph-search">
                <i class="bi bi-search bph-search-icon"></i>
                <input type="text" class="bph-search-input" id="bphSearchInput" placeholder="Cari nama, email, jabatan...">
            </div>
            <button id="bphBulkDeleteBtn" class="bph-btn bph-btn-danger bph-btn-sm" disabled>
                <i class="bi bi-trash3-fill"></i> Hapus Dipilih
            </button>
        </div>
    </div>

    <div class="bph-card-body-flush">
        <div class="bph-table-scroll">
            <table class="bph-table" id="bphUsersTable">
                <thead>
                    <tr>
                        <th style="text-align:center; width:48px;">
                            <input type="checkbox" id="bphSelectAll" style="accent-color:var(--bph-orange); width:16px; height:16px; cursor:pointer;">
                        </th>
                        <th style="text-align:center;">Aksi</th>
                        <th style="text-align:center;">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th style="text-align:center;">Jabatan</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                        @foreach ($users as $no => $user)
                            <tr>
                                <td style="text-align:center;">
                                    <input type="checkbox" class="bph-user-cb" value="{{ $user->id }}"
                                        style="accent-color:var(--bph-orange); width:16px; height:16px; cursor:pointer;">
                                </td>
                                <td style="text-align:center;">
                                    <div style="display:flex; gap:6px; justify-content:center;">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="bph-btn bph-btn-primary bph-btn-sm bph-btn-ico" title="Edit User">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="bph-del-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                                <td style="text-align:center;"><span style="font-weight:800; color:var(--bph-dark);">{{ $users->firstItem() + $no }}</span></td>
                                <td style="font-weight:700;">{{ $user->name }}</td>
                                <td style="color:var(--bph-muted); font-size:0.83rem;">{{ $user->email }}</td>
                                <td style="text-align:center;">
                                    <span class="bph-badge bph-badge-orange">{{ ucfirst($user->jabatan) }}</span>
                                </td>
                                <td style="font-size:0.79rem; color:var(--bph-muted);">{{ $user->created_at }}</td>
                                <td style="font-size:0.79rem; color:var(--bph-muted);">{{ $user->updated_at }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">
                                <div class="bph-empty">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data user yang tersedia.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Not Found -->
        <div id="bphNotFound" style="display:none; text-align:center; padding:32px;">
            <i class="bi bi-exclamation-triangle" style="font-size:1.8rem; color:#F97316; display:block; margin-bottom:8px;"></i>
            <p style="font-weight:700; color:var(--bph-text);">Data tidak ditemukan.</p>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="bph-pagination">
                @if ($users->onFirstPage())
                    <span class="bph-page-btn disabled"><i class="bi bi-chevron-left"></i> Prev</span>
                @else
                    <a class="bph-page-btn" href="{{ $users->previousPageUrl() }}" rel="prev"><i class="bi bi-chevron-left"></i> Prev</a>
                @endif
                @if ($users->hasMorePages())
                    <a class="bph-page-btn" href="{{ $users->nextPageUrl() }}" rel="next">Next <i class="bi bi-chevron-right"></i></a>
                @else
                    <span class="bph-page-btn disabled">Next <i class="bi bi-chevron-right"></i></span>
                @endif
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const pesan = "{{ session('pesan') }}";
    if (pesan.trim()) {
        Swal.fire({ title: 'Sukses!', text: pesan, icon: 'success', confirmButtonColor: '#F97316' });
    }

    // Search
    const searchInput = document.getElementById('bphSearchInput');
    const table = document.getElementById('bphUsersTable');
    const rows = table.querySelectorAll('tbody tr');
    const notFound = document.getElementById('bphNotFound');

    searchInput.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        let found = false;
        rows.forEach(function(row) {
            const cells = row.querySelectorAll('td');
            if (cells.length < 4) { row.style.display = ''; found = true; return; }
            let match = false;
            cells.forEach(function(c, i) { if (i >= 2 && c.textContent.toLowerCase().includes(q)) match = true; });
            row.style.display = match ? '' : 'none';
            if (match) found = true;
        });
        notFound.style.display = (q && !found) ? 'block' : 'none';
    });

    // Checkboxes
    const selectAll = document.getElementById('bphSelectAll');
    const checkboxes = document.querySelectorAll('.bph-user-cb');
    const bulkBtn = document.getElementById('bphBulkDeleteBtn');

    function updateBulkBtn() {
        bulkBtn.disabled = document.querySelectorAll('.bph-user-cb:checked').length === 0;
    }

    selectAll.addEventListener('change', function () {
        checkboxes.forEach(cb => cb.checked = selectAll.checked);
        updateBulkBtn();
    });
    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            selectAll.checked = Array.from(checkboxes).every(c => c.checked);
            updateBulkBtn();
        });
    });

    // Bulk Delete
    bulkBtn.addEventListener('click', function () {
        const ids = Array.from(document.querySelectorAll('.bph-user-cb:checked')).map(c => c.value);
        Swal.fire({
            title: 'Hapus ' + ids.length + ' User?',
            text: 'Data akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#F97316',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("users.bulkDelete") }}';
                const csrf = document.createElement('input');
                csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);
                const method = document.createElement('input');
                method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                form.appendChild(method);
                ids.forEach(id => {
                    const inp = document.createElement('input');
                    inp.type = 'hidden'; inp.name = 'ids[]'; inp.value = id;
                    form.appendChild(inp);
                });
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
</script>
@endsection
