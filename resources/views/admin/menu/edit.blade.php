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

    /* CARD / WRAPPER */
    .menu-wrapper {
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

    /* FORM */
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
        margin-bottom: 18px;
        transition: .2s;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 .15rem rgba(26,115,232,.25);
    }

    textarea.form-control {
        min-height: 100px;
    }

    /* IMAGE CURRENT */
    .current-img {
        margin-top: 8px;
        border-radius: 10px;
        border: 1px solid var(--border-soft);
        padding: 6px;
        background: #fafcff;
        width: 150px;
    }

    /* ERROR BOX */
    .error-box {
        background: #ffe6e6;
        padding: 12px 18px;
        border-radius: 10px;
        border-left: 5px solid #dc3545;
        color: #b30000;
        margin-bottom: 18px;
        font-weight: 600;
    }

    /* BUTTONS */
    .btn-update {
        background: var(--primary);
        color: #fff;
        padding: 10px 26px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        transition: .2s;
    }
    .btn-update:hover {
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

    <h3 class="page-title ms-3">Edit Menu</h3>

    <div class="menu-wrapper">

        <!-- HEADER BIRU -->
        <div class="wrapper-header">
            <i class="fas fa-edit me-2"></i> Form Edit Menu
        </div>

        <div class="form-content">

            @if($errors->any())
                <div class="error-box">
                    {{ implode(', ', $errors->all()) }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.menu.update', $menu->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label class="form-label">Nama Menu</label>
                <input 
                    name="name" 
                    class="form-control" 
                    value="{{ $menu->name }}" 
                    required>

                <label class="form-label">Harga</label>
                <input 
                    name="price" 
                    class="form-control" 
                    value="{{ $menu->price }}">

                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" 
                            {{ $menu->category_id == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>

                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ $menu->description }}</textarea>

                <label class="form-label">Gambar (Opsional)</label>
                <input type="file" name="image" class="form-control">

                @if($menu->image)
                    <p class="text-muted mt-2 mb-1">Gambar saat ini:</p>
                    <img src="/uploads/menu/{{ $menu->image }}" class="current-img">
                @endif

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.menu.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>

                    <button class="btn-update">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
