@extends('layouts.admin')
@section('content')

<style>
    :root {
        --primary: #1A73E8;
        --primary-dark: #0d47a1;
        --bg-soft: #F4F7FE;
        --border-soft: #dce6ff;
        --text-dark: #1c1c1c;
    }

    .page-container {
        background: var(--bg-soft);
        padding: 25px;
        border-radius: 14px;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--primary-dark);
        border-left: 5px solid var(--primary);
        padding-left: 12px;
        margin-bottom: 24px;
    }

    /* CARD WRAPPER FULL WIDTH */
    .category-wrapper {
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 5px 18px rgba(0,0,0,.05);
        width: 100%;
        max-width: 100%;
    }

    .form-label {
        font-weight: 600;
        color: var(--primary-dark);
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 14px;
        border: 1px solid #c5d6f7;
        transition: .2s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 .15rem rgba(26,115,232,.25);
    }

    .btn-save {
        background: var(--primary);
        color: #fff;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: .2s;
    }

    .btn-save:hover {
        background: var(--primary-dark);
    }

    /* TABLE */
    .table-card {
        margin-top: 25px;
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0,0,0,.05);
        border: 1px solid var(--border-soft);
        padding: 0;
    }

    thead {
        background: var(--bg-soft);
    }

    thead th {
        color: var(--primary-dark);
        font-weight: 700;
        padding: 14px;
        text-align: center;
    }

    tbody td {
        padding: 14px;
        vertical-align: middle;
        text-align: center;
        font-size: 15px;
        color: #333;
    }

    tbody tr:hover {
        background: #f2f6ff;
    }

    .btn-action {
        padding: 7px 14px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        border: none;
    }

    .btn-edit {
        background: var(--primary);
        color: #fff;
    }

    .btn-edit:hover {
        background: var(--primary-dark);
    }

    .btn-delete {
        background: #dc3545;
        color: #fff;
    }

    .btn-delete:hover {
        background: #b22030;
    }

    .btn-back {
        background: #6c7a91;
        color: #fff;
        padding: 8px 18px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: .2s;
    }

    .btn-back:hover {
        background: #5a657a;
    }

</style>

<div class="container-fluid page-container">

    <!-- PAGE HEADER -->
    <h3 class="page-title">
        Tambah Kategori
    </h3>

    <!-- FORM -->
    <div class="category-wrapper">
        <form method="POST" action="{{ route('admin.category.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kategori</label>
                <input name="name" class="form-control" placeholder="Masukkan nama kategori" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" placeholder="Masukkan deskripsi (opsional)"></textarea>
            </div>

                        <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.category.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>

                <button class="btn-save">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>

    <!-- TABLE LIST -->
    @if(isset($categories) && count($categories) > 0)
    <div class="table-card mt-4">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" style="table-layout: auto;">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Nama</th>
                        <th width="40%">Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>

                            <td>
                                <strong style="color:var(--primary-dark);">
                                    {{ $category->name }}
                                </strong>
                            </td>

                            <td>{{ $category->description ?? '-' }}</td>

                            <td>
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.category.edit', $category->id) }}" 
                                        class="btn-action btn-edit">
                                        Edit
                                    </a>

                                    <form method="POST" 
                                          action="{{ route('admin.category.destroy', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-action btn-delete" onclick="return confirm('Hapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @endif

</div>

@endsection
