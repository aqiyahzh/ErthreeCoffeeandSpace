@extends('layouts.admin')

@section('content')

<div class="container-fluid p-4" style="background-color:#f1f3f5;">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="mb-2" style="color:#2c5aa0; font-weight:700;">Kelola Servis</h2>
            <p class="text-muted mb-0">Kelola layanan yang tampil di website</p>
        </div>

        <a href="{{ route('admin.service.create') }}" class="btn btn-add">
            <i class="fas fa-plus me-2"></i>Tambah Servis
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif


    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0" style="border-radius:6px; overflow:hidden;">

        <!-- Header -->
        <div class="card-header border-0" style="background:#2c5aa0; padding:1.1rem 1.3rem;">
            <h5 class="mb-0" style="color:white; font-weight:600;">
                <i class="fas fa-cogs me-2"></i>Daftar Services
            </h5>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table mb-0" style="width:100%;">

                <thead style="background:#e9eef5;">
                    <tr>
                        <th class="table-head">Gambar</th>
                        <th class="table-head">ID</th>
                        <th class="table-head">Title</th>
                        <th class="table-head">Deskripsi</th>
                        <th class="table-head">Icon</th>
                        <th class="table-head">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($services as $s)
                    <tr class="table-row">

                        <td class="text-center">
                            @if($s->image)
                            <img src="{{ asset('uploads/service/'.$s->image) }}"
                                width="70" height="70"
                                class="rounded-circle"
                                style="object-fit:cover; border:2px solid #2c5aa0;">
                            @else
                            <div class="img-placeholder">
                                <i class="fas fa-image"></i>
                            </div>
                            @endif
                        </td>

                        <td class="text-center fw-bold" style="color:#2c5aa0;">
                            {{ $s->id }}
                        </td>

                        <td class="fw-bold" style="color:#2c5aa0;">
                            {{ $s->title }}
                        </td>

                        <td style="color:#476b9e;">{{ $s->subtitle }}</td>

                        <td class="text-center">
                            @if($s->icon)
                            <i class="{{ $s->icon }}" style="color:#2c5aa0; font-size:1.5rem;"></i>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.service.edit', $s->id) }}"
                                    class="btn btn-sm btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.service.destroy', $s->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus service ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-cogs fa-3x mb-3" style="color:#b0b9c7;"></i>
                            <p class="text-muted">Belum ada data service</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

<style>
    /* Header Tabel */

    :root {
        --primary-color: #2c5aa0;
        --primary-dark: #224679;
        --primary-light: #e8f0f8;
        --danger-color: #dc3545;
        --success-color: #28a745;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.45rem 0.75rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 500;
        transition: .2s;
        text-decoration: none !important;
    }

    .btn-edit {
        background-color: var(--primary-color);
        color: white;
        border: none;
        padding: .55rem .8rem;
        /* ⬅️ SAMA DENGAN DELETE */
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-edit:hover {
        background-color: var(--primary-dark);
    }

    .table-head {
        padding: 1rem;
        font-weight: 600;
        color: #2c5aa0;
        text-align: center;
        border-bottom: 2px solid #d7dfea;
    }

    /* Baris */
    .table-row {
        height: 95px;
        vertical-align: middle;
        border-bottom: 1px solid #e3e7ef;
    }

    .table-row:hover {
        background: #f4f7fc;
    }

    /* Tombol Tambah */
    .btn-add {
        background: #2c5aa0;
        color: white;
        padding: .7rem 1.6rem;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, .15);
    }

    .btn-add:hover {
        background: #234b7e;
    }

    /* Tombol Delete */
    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: .55rem .8rem;
        border-radius: 6px;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    /* Placeholder Gambar */
    .img-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #e4eaf2;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #2c5aa0;
        border: 2px solid #2c5aa0;
        font-size: 1.3rem;
    }
</style>

@endsection