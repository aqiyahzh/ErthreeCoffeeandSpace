@extends('layouts.admin')
@section('content')

<style>
    :root {
        --primary: #1a3c80;
        --primary-dark: #0d47a1;
        --bg-soft: #F4F7FE;
        --border-soft: #dce6ff;
        --text-dark: #1a3c80;
    }

    .page-title {
        font-size: 26px;
        font-weight: 700;
        color: var(--primary-dark);
        border-left: 5px solid var(--primary);
        padding-left: 12px;
        margin-bottom: 25px;
    }

    /* CARD */
    .carousel-wrapper {
        background: #fff;
        border-radius: 6px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 5px 18px rgba(0,0,0,.06);
        overflow: hidden;
    }

    /* HEADER */
    .wrapper-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 18px 22px;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-content {
        padding: 28px 30px;
    }

    /* FORM */
    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
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

    .card-section-title {
        font-size: 17px;
        font-weight: 700;
        color: var(--primary-dark);
        margin-top: 20px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .divider {
        height: 2px;
        background: var(--border-soft);
        margin-bottom: 16px;
    }

    /* IMAGE PREVIEW */
    .current-image-box {
        margin-top: 12px;
        background: var(--bg-soft);
        border: 1px solid var(--border-soft);
        border-radius: 12px;
        padding: 12px;
        width: fit-content;
    }

    .current-image-box img {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,.12);
        object-fit: cover;
    }

    /* BUTTON */
    .btn-save {
        background: var(--primary);
        color: #fff;
        padding: 10px 26px;
        border-radius: 12px;
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
        padding: 9px 22px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        transition: .2s;
    }

    .btn-back:hover {
        background: #5a657a;
    }
</style>


<div class="container-fluid">

    <h3 class="page-title">Edit Carousel</h3>

    <div class="carousel-wrapper">

        <!-- HEADER -->
        <div class="wrapper-header">
            <i class="fas fa-edit"></i> Form Edit Carousel
        </div>

        <form action="{{ route('admin.carousel.update', $carousel->id) }}"
              method="POST" enctype="multipart/form-data" class="form-content">

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div class="mb-3">
                <label class="form-label">Judul Carousel</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ $carousel->title }}"
                       required>
            </div>

            <!-- IMAGE SECTION -->
            <div class="card-section-title">
                <i class="fas fa-image"></i> Gambar Carousel
            </div>
            <div class="divider"></div>

            <div class="mb-2">
                <input type="file" name="image" class="form-control" accept="image/*">
                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
            </div>

            @if($carousel->image)
                <div class="current-image-box">
                    <p class="text-muted mb-2">Gambar saat ini:</p>
                    <img src="{{ asset('uploads/carousel/'.$carousel->image) }}"
                         width="240" height="150">
                </div>
            @endif

            <!-- BUTTON -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('admin.carousel.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>

                <button class="btn-save">
                    <i class="fas fa-save me-1"></i> Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
