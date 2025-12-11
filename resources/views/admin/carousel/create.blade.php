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

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--primary-dark);
        border-left: 5px solid var(--primary);
        padding-left: 12px;
        margin-bottom: 24px;
    }

    /* CARD WRAPPER LEBIH LEBAR & MENYESUAIKAN FULL KONTEN */
    .carousel-wrapper {
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
        border: 1px solid #c5d6f7;
        padding: 10px 14px;
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

    .btn-secondary-custom {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 500;
    }

    .card-section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-top: 22px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .divider {
        height: 2px;
        width: 100%;
        background: var(--border-soft);
        margin: 8px 0 16px 0;
    }

    /* CONTAINER FULL WIDTH */
    .page-container {
        background: var(--bg-soft);
        padding: 25px;
        border-radius: 14px;
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

    <h3 class="page-title">Tambah Carousel</h3>

    <div class="carousel-wrapper">

        <form action="{{ route('admin.carousel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- TITLE -->
            <label class="form-label">Judul Carousel</label>
            <input type="text" 
                   name="title" 
                   class="form-control mb-4"
                   placeholder="Masukkan judul"
                   required>

            <!-- IMAGE -->
            <div class="card-section-title">
                <i class="fas fa-image"></i> Upload Gambar
            </div>
            <div class="divider"></div>

            <input type="file" 
                   name="image" 
                   class="form-control mb-2"
                   accept="image/*"
                   required>

            <small class="text-muted">Format: JPG, PNG — Maks 5MB</small>

            <!-- BUTTONS -->
                        <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.carousel.index') }}" class="btn-back">
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
