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
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #6c7a91;
        margin-bottom: 25px;
    }

    /* CARD FULL WIDTH */
    .card-custom {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 8px 20px rgba(0,0,0,.05);
        width: 100%;
        margin: 0;
        overflow: hidden;
    }

    /* HEADER SERAGAM */
    .card-header-custom {
        background: linear-gradient(135deg, #1a3c80);
        padding: 20px 25px;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
    }

    /* LABEL */
    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
    }

    /* INPUT STYLE */
    .form-control,
    .form-check-input {
        border-radius: 10px;
        border: 1px solid #c5d6f7;
        padding: 10px 14px;
        transition: .2s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 .15rem rgba(26,115,232,.25);
    }

    /* PREVIEW IMAGE */
    .preview-img {
        width: 150px;
        border-radius: 10px;
        margin-top: 12px;
        border: 1px solid var(--border-soft);
        background: #fafcff;
        padding: 6px;
        object-fit: cover;
    }

    /* BUTTON – SAVE */
    .btn-save {
        background: var(--primary);
        border: none;
        padding: 10px 26px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        transition: .2s;
    }
    .btn-save:hover {
        background: var(--primary-dark);
    }

    /* BUTTON – BACK */
    .btn-back {
        background: #6c7a91;
        color: #fff;
        border-radius: 10px;
        padding: 10px 22px;
        font-weight: 600;
        border: none;
        transition: .2s;
    }
    .btn-back:hover {
        background: #5a657a;
    }
</style>


<div class="container-fluid px-0">

    <h3 class="page-title ms-3">Edit Service</h3>
    <p class="page-subtitle ms-3">Perbarui informasi service yang ditampilkan di website.</p>

    <div class="card-custom">

        <div class="card-header-custom">
            <i class="fas fa-edit me-2"></i> Form Edit Service
        </div>

        <div class="p-4">

            <form action="{{ route('admin.service.update', $service->id) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Judul Service</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ $service->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control"
                           value="{{ $service->subtitle }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ $service->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon (Font Awesome)</label>
                    <input type="text" name="icon" class="form-control"
                           value="{{ $service->icon }}" placeholder="Contoh: fas fa-coffee">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Service</label>
                    <input type="file" name="image" class="form-control">

                    @if($service->image)
                        <img src="{{ asset('uploads/service/'.$service->image) }}" class="preview-img">
                    @endif
                </div>

                <div class="mb-3 form-check mt-4">
                    <input type="checkbox" name="is_active" class="form-check-input"
                           {{ $service->is_active ? 'checked' : '' }}>
                    <label class="form-check-label">Tampilkan Service (Aktif)</label>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.service.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                    <button class="btn-save">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
