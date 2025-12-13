@extends('layouts.admin')
@section('content')

<style>
    :root {
        --primary: #2c5aa0;
        --primary-dark: #224679;
        --danger: #dc3545;
    }

    .btn-main {
        background: var(--primary);
        color: white;
        padding: .6rem 1.5rem;
        border-radius: 6px;
        text-decoration: none;
        transition: .3s ease;
        font-weight: 500;
        border: none;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 28px;
        margin-top: 22px;
    }

    .menu-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 5px 14px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: 0.25s ease;
    }

    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }

    .menu-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 14px;
        margin-bottom: 14px;
    }

    .menu-name {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #222;
        text-align: center;
    }

    .menu-desc {
        font-size: 13px;
        color: #666;
        margin-bottom: 12px;
        min-height: 40px;
        text-align: center;
    }

    /* Harga + Aksi */
    .menu-price-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #f7f7f7;
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    .price-text {
        white-space: nowrap;
    }

    .price-actions {
        display: flex;
        gap: 10px;
    }

    .price-actions a {
        color: var(--primary);
        font-size: 14px;
        text-decoration: none;
    }

    .price-actions a:hover {
        opacity: 0.75;
    }

    .price-actions .delete {
        color: var(--danger);
    }

    /* Harga + Aksi */
    .menu-price-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #f7f7f7;
        padding: 6px 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #444;
    }

    .price-text {
        white-space: nowrap;
    }

    .price-divider {
        width: 1px;
        height: 18px;
        background: #ccc;
    }

    .price-actions {
        display: flex;
        gap: 8px;
    }

    /* Kotak ikon */
    .icon-box {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        background: #e8f0f8;
        color: #2c5aa0;
        text-decoration: none;
        transition: 0.2s;
    }

    .icon-box:hover {
        background: #2c5aa0;
        color: #fff;
    }

    .icon-box.delete {
        background: #fdeaea;
        color: #dc3545;
    }

    .icon-box.delete:hover {
        background: #dc3545;
        color: #fff;
    }


    /* Pagination */
    .menu-pagination {
        margin-top: 28px;
        text-align: center;
    }

    .menu-pagination .page-link {
        padding: 7px 12px;
        margin: 0 4px;
        border-radius: 6px;
        background: #f0f0f0;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        border: 1px solid #ddd;
    }

    .menu-pagination .active {
        background: #144d8aff;
        color: #fff;
        border-color: #007bff;
    }
</style>

<div>

    <!-- Header -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div style="font-weight:700; font-size:24px; color:#2c5aa0;">
            Daftar Menu
        </div>

        <a href="{{ route('admin.menu.create') }}" class="btn-main">
            <i class="fas fa-plus-circle me-2"></i> Tambah Menu
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
    <div style="background:#e9f8ee;border:1px solid #c7e8d1;padding:12px 14px;border-radius:8px;margin-bottom:16px;font-size:14px;">
        {{ session('success') }}
    </div>
    @endif

    <!-- GRID -->
    <div class="menu-grid">
        @forelse($menus as $m)
        <div class="menu-card">

            @if($m->image)
            <img src="/uploads/menu/{{ $m->image }}" alt="Menu Image">
            @endif

            <div class="menu-name">{{ $m->name }}</div>

            <div class="menu-desc">
                {{ \Illuminate\Support\Str::limit($m->description, 80) }}
            </div>

            <!-- Harga + Ikon -->
            <div class="menu-price-actions">
                <span class="price-text">
                    Harga: {{ $m->price ?? '-' }}
                </span>

                <span class="price-divider"></span>

                <div class="price-actions">
                    <a href="{{ route('admin.menu.edit', $m->id) }}" title="Edit" class="icon-box">
                        <i class="fas fa-pen"></i>
                    </a>

                    <form action="{{ route('admin.menu.destroy', $m->id) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#"
                            class="icon-box delete"
                            title="Hapus"
                            onclick="event.preventDefault(); if(confirm('Hapus menu ini?')) this.closest('form').submit();">
                            <i class="fas fa-trash"></i>
                        </a>
                    </form>
                </div>
            </div>


        </div>
        @empty
        <div style="font-size:15px;">Tidak ada menu. Tambahkan item baru.</div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="menu-pagination">
        @if($menus->lastPage() > 1)
        @for($i = 1; $i <= $menus->lastPage(); $i++)
            <a href="{{ $menus->url($i) }}"
                class="page-link {{ $menus->currentPage() == $i ? 'active' : '' }}">
                {{ $i }}
            </a>
            @endfor
            @endif
    </div>

</div>

@endsection