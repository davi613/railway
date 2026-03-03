@extends('be.master')

@section('sidebar')
    @include('be.sidebar')
@endsection

@section('navbar')
    @include('be.navbar')
@endsection

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: navy;">
                    <div>
                        <h5 class="mb-0 font-weight-bold">Manajemen User</h5>
                        <small style="color: rgba(255,255,255,0.7);">Daftar seluruh akun user dan hak akses</small>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-light text-primary font-weight-bold px-3 py-2 shadow-sm">
                        <i class="fas fa-plus-circle"></i> Tambah User
                    </a>
                </div>

                <div class="card-body bg-light">
                    {{-- Search + Bulk Delete --}}
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <form class="form-inline w-100">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text text-white" style="background-color: navy;">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" style="border: 1px solid navy;" id="searchInput" placeholder="Cari nama, email, atau jabatan...">
                                    <div class="input-group-append">
                                        <button type="button" class="btn text-white" style="background-color: navy;" id="searchButton">Cari</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4 text-md-right mt-3 mt-md-0">
                            <button id="bulkDeleteBtn" class="btn text-white shadow-sm" style="background-color: red;" disabled>
                                <i class="fas fa-trash-alt"></i> Hapus yang Dipilih
                            </button>
                        </div>
                    </div>

                    {{-- Tabel User --}}
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered bg-white" id="usersTable">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Dibuat</th>
                                    <th>Diperbarui</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->count() > 0)
                                    @foreach ($users as $no => $user)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" class="user-checkbox" value="{{ $user->id }}">
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm text-white" style="background-color: orange;">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline form-hapus">
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- <button type="button" class="btn btn-sm text-white" style="background-color: red;">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button> --}}
                                                    </form>
                                                </div>
                                            </td>
                                            <td class="text-center font-weight-bold">{{ $users->firstItem() + $no }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">
                                                <span class="badge text-white px-2 py-1" style="background-color: navy;">{{ $user->jabatan }}</span>
                                            </td>
                                            <td class="text-muted">{{ $user->created_at }}</td>
                                            <td class="text-muted">{{ $user->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            <em>Belum ada data user yang tersedia.</em>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        <div id="notFoundMessage" class="text-center mt-3" style="color: red; display:none;">
                            <strong><i class="fas fa-exclamation-circle"></i> Data tidak ditemukan!</strong>
                        </div>
                    </div>
                    {{-- Pagination --}}
@if ($users->hasPages())
    <div class="d-flex justify-content-center mt-3">
        <ul class="pagination">
            {{-- Tombol Previous --}}
            @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">Previous</a>
                </li>
            @endif

            {{-- Tombol Next --}}
            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </div>
@endif


                </div>
            </div>
        </div>
    </div>  
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const pesan = "{{ session('pesan') }}";
        if (pesan.trim() !== '') {
            Swal.fire({
                title: 'Sukses!',
                text: pesan,
                icon: 'success',
                confirmButtonColor: 'navy'
            });
        }

        const searchInput = document.getElementById('searchInput');
        const searchButton = document.getElementById('searchButton');
        const usersTable = document.getElementById('usersTable');
        const rows = usersTable.getElementsByTagName('tr');
        const notFoundMessage = document.getElementById('notFoundMessage');

        searchButton.addEventListener('click', function () {
            const searchText = searchInput.value.toLowerCase();
            let foundAny = false;

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                if (cells.length < 3) continue;

                let found = false;
                for (let j = 2; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.includes(searchText)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
                if (found) foundAny = true;
            }

            notFoundMessage.style.display = foundAny ? 'none' : 'block';
        });

        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.user-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            toggleBulkDeleteButton();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                selectAll.checked = Array.from(checkboxes).every(cb => cb.checked);
                toggleBulkDeleteButton();
            });
        });

        function toggleBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            bulkDeleteBtn.disabled = checkedBoxes.length === 0;
        }

        bulkDeleteBtn.addEventListener('click', function () {
            const checkedBoxes = document.querySelectorAll('.user-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: `Anda akan menghapus ${ids.length} user!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'red',
                cancelButtonColor: 'navy',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("users.bulkDelete") }}';

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    const method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    ids.forEach(id => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'ids[]';
                        input.value = id;
                        form.appendChild(input);
                    });

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data user akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'navy',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
