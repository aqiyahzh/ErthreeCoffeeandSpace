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

    .card-wrapper {
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

    textarea.form-control {
        min-height: 90px;
    }

    /* ACTION BAR */
    .action-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 25px;
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


    .btn-save {
        background: var(--primary);
        color: #fff;
        padding: 10px 28px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: .2s;
    }

    .btn-save:hover {
        background: var(--primary-dark);
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

    <!-- PAGE HEADER -->
    <h3 class="page-title">Tambah Menu</h3>

    <!-- CARD WRAPPER -->
    <div class="card-wrapper">

        @if($errors->any())
            <div class="alert-error">
                <strong>Periksa input berikut:</strong><br>
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        <form id="menuForm" method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Menu</label>
                <input name="name" class="form-control" placeholder="Masukkan nama menu" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input name="price" class="form-control" placeholder="Masukkan harga">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" placeholder="Masukkan deskripsi"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Menu</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Format: JPG, PNG — Maks 5MB</small>
            </div>

                        <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.menu.index') }}" class="btn-back">
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
