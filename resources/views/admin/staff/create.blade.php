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
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: .2s;
    }
    .btn-back:hover {
        background: #5a657a;
    }
</style>

<div class="container-fluid page-container">

    <h3 class="page-title">Tambah Staff</h3>

    <div class="card-wrapper">

        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Staff</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- Jabatan -->
            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="position" class="form-control" required>
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label class="form-label">Foto</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
                <small class="text-muted">Format gambar: JPG, PNG — Maks 5MB</small>
            </div>

            <!-- BUTTONS (Left & Right) -->
            <div class="d-flex justify-content-between mt-4">
                
                <!-- Tombol Kembali -->
                <a href="{{ route('admin.staff.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn-save">
                    <i class="fas fa-save me-1"></i> Simpan
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
