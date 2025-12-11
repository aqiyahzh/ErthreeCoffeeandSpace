@extends('layouts.admin')

@section('content')

<div class="container-fluid p-4" style="background-color: #f1f3f5;">
    
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="mb-2" style="color:#2c5aa0; font-weight:700;">Kelola Staff</h2>
            <p class="text-muted mb-0">Kelola data staff café Anda</p>
        </div>
        
        <a href="{{ route('admin.staff.create') }}" class="btn btn-add">
            <i class="fas fa-plus me-2"></i>Tambah Staff
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- CARD -->
    <div class="card shadow-sm border-0" style="border-radius:6px; overflow:hidden;">

        <div class="card-header border-0" style="background:#2c5aa0; padding:1.1rem 1.3rem;">
            <h5 class="mb-0" style="color:white; font-weight:600;">
                <i class="fas fa-users me-2"></i>Daftar Staff
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table mb-0" style="width:100%;">
                <thead style="background:#e9eef5;">
                    <tr>
                        <th class="table-head">Foto</th>
                        <th class="table-head">Nama</th>
                        <th class="table-head">Jabatan</th>
                        <th class="table-head">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($staff as $s)
                    <tr class="table-row">

                        <!-- FOTO -->
                        <td class="text-center">
                            @if($s->photo)
                                <img src="{{ asset('uploads/staff/'.$s->photo) }}"
                                    width="80" height="80"
                                    class="rounded-circle"
                                    style="object-fit:cover; border:2px solid #2c5aa0;">
                            @else
                                <div class="img-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </td>

                        <!-- NAMA -->
                        <td class="text-center fw-bold" style="color:#2c5aa0; font-size:1.1rem;">
                            {{ $s->name }}
                        </td>

                        <!-- JABATAN -->
                        <td class="text-center" style="color:#476b9e; font-weight:600;">
                            {{ $s->position }}
                        </td>

                        <!-- AKSI -->
                        <td class="text-center py-3">
                            <div class="d-flex justify-content-center gap-2 flex-wrap">

                                <a href="{{ route('admin.staff.edit', $s->id) }}"
                                   class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('admin.staff.destroy', $s->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus staff ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <i class="fas fa-users fa-3x mb-3" style="color:#b0b9c7;"></i>
                            <p class="text-muted">Belum ada data staff</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

<style>
    :root {
        --primary-color: #2c5aa0;
        --primary-dark: #224679;
        --primary-light: #e8f0f8;
        --danger-color: #dc3545;
        --success-color: #28a745;
    }

    /* ACTION BUTTON */
    .btn-action {
        display:inline-flex;
        align-items:center;
        justify-content:center;
        padding:0.45rem 0.75rem;
        border:none;
        border-radius:6px;
        cursor:pointer;
        font-size:0.8rem;
        transition:.2s;
        color:white;
    }

    .btn-edit{
        background:var(--primary-color);
    }
    .btn-edit:hover{
        background:var(--primary-dark);
    }

    .btn-delete{
        background:#dc3545;
    }
    .btn-delete:hover{
        background:#b52a36;
    }

    .table-head{
        padding:1rem;
        font-weight:600;
        color:#2c5aa0;
        text-align:center;
        border-bottom:2px solid #d7dfea;
    }

    .table-row{
        height:95px;
        vertical-align:middle;
        border-bottom:1px solid #e3e7ef;
    }
    .table-row:hover{
        background:#f4f7fc;
    }

    .btn-add{
        background:#2c5aa0;
        color:white;
        padding:.7rem 1.6rem;
        border-radius:8px;
        font-weight:600;
        border:none;
    }
    .btn-add:hover{
        background:#224679;
    }

    .img-placeholder{
        width:80px; height:80px;
        border-radius:50%;
        background:#e4eaf2;
        display:flex;
        justify-content:center;
        align-items:center;
        color:#2c5aa0;
        border:2px solid #2c5aa0;
        font-size:1.6rem;
    }
</style>

@endsection
