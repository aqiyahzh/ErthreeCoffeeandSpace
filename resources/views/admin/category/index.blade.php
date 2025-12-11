@extends('layouts.admin')
@section('content')

<style>
    :root {
        --primary: #2c5aa0;
        --primary-dark: #224679;
        --primary-soft: #e8f0f8;
        --danger: #dc3545;
        --light: #f8f9fa;
    }

    .btn-main {
        background: var(--primary);
        color: white;
        padding: .6rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        transition: .3s ease;
        font-weight: 500;
        border: none;
    }

    .btn-main:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(34, 70, 121, .3);
        color: white;
    }

    .card-header {
        background: var(--primary);
        padding: 1.1rem 1.25rem;
        border: none;
    }

    .card-header h3 {
        color: white;
        font-weight: 600;
        margin: 0;
        font-size: 1.2rem;
    }

    table thead {
        background: var(--primary-soft);
    }

    table thead th {
        color: var(--primary);
        font-weight: 600;
        padding: 1rem;
        text-align: center;
    }

    .table-hover tbody tr:hover {
        background: #f4f8ff !important;
    }

    .badge-count {
        background: var(--primary);
        color: white;
        padding: .45rem .8rem;
        border-radius: 6px;
        font-size: .85rem;
        font-weight: 600;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .45rem .75rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: .83rem;
        font-weight: 500;
        transition: .2s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-edit {
        background: var(--primary);
        color: white;
    }

    .btn-edit:hover {
        background: var(--primary-dark);
    }

    .btn-delete {
        background: var(--danger);
        color: white;
    }

    .btn-delete:hover {
        background: #b7202f;
    }
</style>

<div class="container-fluid p-4" style="background-color: var(--light);">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-2" style="color: var(--primary); font-weight: 600;">Kategori Menu</h2>
            <p class="text-muted mb-0">Kelola kategori makanan dan minuman</p>
        </div>
        <div>
            <a href="{{ route('admin.category.create') }}" class="btn-main">
                <i class="fas fa-plus-circle me-2"></i>Tambah Kategori
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" 
             style="border-left:4px solid #28a745;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card Tabel -->
    <div class="card shadow-sm" style="border-radius:12px;">
        <div class="card-header">
            <h3><i class="fas fa-folder me-2"></i>Daftar Kategori</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th width="30%">Nama Kategori</th>
                        <th width="25%">Slug</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $c)
                    <tr>
                        <td class="text-center" style="font-weight:600; color:var(--primary);">
                            {{ $c->name }}
                        </td>

                        <td class="text-center" style="color:#4a7bc8; font-weight:500;">
                            {{ $c->slug }}
                        </td>

                        <td class="text-center">

                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.category.edit', $c->id) }}"
                                   class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn-action btn-delete"
                                        onclick="deleteData('{{ $c->id }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <form id="delete-form-{{ $c->id }}"
                                      action="{{ route('admin.category.destroy', $c->id) }}"
                                      method="POST"
                                      style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            </div>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="fas fa-folder-open fa-3x mb-3" style="color:#cbd5e0;"></i>
                            <p class="text-muted">Belum ada kategori</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

<script>
function deleteData(id) {
    if (confirm("Hapus kategori ini? Tindakan tidak dapat dibatalkan!")) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>

@endsection
