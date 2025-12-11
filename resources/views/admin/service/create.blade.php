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

    /* CARD WRAPPER */
    .card-wrapper {
        background: #fff;
        padding: 30px;
        border-radius: 14px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 5px 16px rgba(0,0,0,.05);
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

    textarea.form-control {
        min-height: 90px;
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

    .alert-error {
        background: #ffe8e8;
        padding: 14px;
        border-left: 4px solid #d9534f;
        border-radius: 8px;
        font-size: 15px;
        color: #a94442;
        margin-bottom: 20px;
    }
</style>

<div class="container-fluid page-container">

    <h3 class="page-title">Tambah Service</h3>

    <div class="card-wrapper">

        @if($errors->any())
            <div class="alert-error">
                <strong>Periksa input berikut:</strong><br>
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- TITLE -->
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" placeholder="Masukkan judul service" required>
            </div>

            <!-- SUBTITLE -->
            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" name="subtitle" class="form-control" placeholder="Masukkan subtitle">
            </div>

            <!-- DESCRIPTION -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" placeholder="Masukkan deskripsi"></textarea>
            </div>

            <!-- ICON -->
            <div class="mb-3">
                <label class="form-label">Icon (font-awesome class)</label>
                <input type="text" name="icon" class="form-control" placeholder="contoh: fa fa-truck">
            </div>

            <!-- IMAGE -->
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Format: JPG, PNG — Maks 5MB</small>
            </div>

            <!-- ACTIVE -->
            <div class="form-check mb-3 mt-2">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" checked>
                <label class="form-check-label" for="is_active">Active</label>
            </div>

            <!-- BUTTONS -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.service.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>

                <button class="btn-save">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
