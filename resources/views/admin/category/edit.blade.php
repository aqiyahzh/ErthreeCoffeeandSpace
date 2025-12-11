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
        margin-bottom: 10px;
        margin-top: 10px;
        padding-left: 12px;
        border-left: 5px solid var(--primary);
    }

    .category-wrapper {
        background: #ffffff;
        border-radius: 6px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 8px 20px rgba(0,0,0,.05);
        width: 100%;
        margin: 0 12px;
        overflow: hidden;
    }

    /* HEADER BIRU */
    .wrapper-header {
        background: linear-gradient(135deg, var(--primary));
        padding: 18px 22px;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        display: flex;
        align-items: center;
    }

    .form-content {
        padding: 30px 32px;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 6px;
        display: block;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #c5d6f7;
        padding: 10px 14px;
        margin-bottom: 20px;
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
        padding: 10px 26px;
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
        padding: 10px 26px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: .2s;
    }

    .btn-back:hover {
        background: #5a657a;
    }
</style>

<div class="container-fluid px-0">

    <h3 class="page-title ms-3">Edit Kategori Menu</h3>

    <div class="category-wrapper">

        <!-- HEADER BIRU -->
        <div class="wrapper-header">
            <i class="fas fa-edit me-2"></i> Form Edit Kategori Menu
        </div>

        <div class="form-content">

            <form method="POST" action="{{ route('admin.category.update', $category->id) }}">
                @csrf
                @method('PUT')

                <label class="form-label">Nama Kategori</label>
                <input 
                    name="name" 
                    class="form-control" 
                    value="{{ $category->name }}" 
                    required
                >

                <label class="form-label">Deskripsi</label>
                <textarea 
                    name="description" 
                    class="form-control"
                >{{ $category->description }}</textarea>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.category.index') }}" class="btn-back">
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
