@extends('layouts.admin')

@section('content')

<style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1a3c80;
        margin-bottom: 5px;
    }
    .page-subtitle {
        color: #6c7a91;
        margin-bottom: 25px;
    }

    .card-custom {
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid #e6e6e6;
        padding: 0;
        overflow: hidden;
        max-width: 1200px; /* ⬅️ LEBIH LEBAR */
        margin: auto;
    }

    .card-header-custom {
        background: #1a3c80;
        padding: 18px 22px;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-label {
        font-weight: 600;
        color: #1a3c80;
    }

    .form-control {
        border-radius: 10px;
    }

    .preview-img {
        width: 140px;
        border-radius: 10px;
        margin-top: 10px;
        border: 2px solid #d1e0ff;
        object-fit: cover;
    }

    .btn-save {
        background: #1a73e8;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        width: 180px;
    }
    .btn-save:hover {
        background: #155fc0;
    }

    .btn-back {
        background: #6c7a91;
        color: #fff;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
    }
    .btn-back:hover {
        background: #5a657a;
    }
</style>


<div class="container-fluid">

    <h3 class="page-title">Edit Staff</h3>
    <p class="page-subtitle">Perbarui informasi staff.</p>

    <div class="card-custom shadow-sm">

        <div class="card-header-custom">
            <span><i class="fas fa-user-edit me-2"></i>Form Edit Staff</span>
        </div>

        <div class="p-4">

            <form action="{{ route('admin.staff.update', $staff->id) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Staff -->
                <div class="mb-3">
                    <label class="form-label">Nama Staff</label>
                    <input type="text" name="name" class="form-control form-control-lg" 
                        value="{{ $staff->name }}" required>
                </div>

                <!-- Jabatan -->
                <div class="mb-3">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="position" class="form-control form-control-lg"
                        value="{{ $staff->position }}" required>
                </div>

                <!-- Upload Foto -->
                <div class="mb-3">
                    <label class="form-label">Foto Baru</label>
                    <input type="file" name="photo" class="form-control">

                    @if($staff->photo)
                        <img src="{{ asset('uploads/staff/'.$staff->photo) }}" 
                            class="preview-img mt-2">
                    @endif
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.staff.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                    <button type="submit" class="btn-save">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
