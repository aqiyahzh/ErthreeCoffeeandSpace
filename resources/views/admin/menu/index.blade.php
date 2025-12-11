@extends('layouts.admin')
@section('content')

<style>
    /* --- GRID --- */
        :root {
        --primary: #2c5aa0;
        --primary-dark: #224679;
        --primary-soft: #e8f0f8;
        --danger: #dc3545;
        --light: #f8f9fa;
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

    /* --- CARD --- */
    .menu-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 5px 14px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: 0.25s ease;
    }

    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.12);
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
    }

    .menu-desc {
        font-size: 13px;
        color: #666;
        margin-bottom: 10px;
        min-height: 40px;
    }

    .menu-price {
        font-size: 14px;
        font-weight: 600;
        color: #444;
        background: #f7f7f7;
        padding: 5px 14px;
        border-radius: 8px;
        margin-bottom: 14px;
    }

    /* --- ACTIONS --- */
    .actions {
        display: flex;
        justify-content: center;
        gap: 18px;
        margin-top: 8px;
    }

    .actions a {
        font-size: 14px;
        font-weight: 600;
        color: #0b4a8fff;
        text-decoration: none;
        cursor: pointer;
    }

    .actions a:hover {
        text-decoration: underline;
    }

    .delete-link {
        color: #d9534f !important;
        font-weight: 600;
    }

    /* --- PAGINATION --- */
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

    <!-- Header Title + Button -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div style="font-weight:700; font-size:24px; color:#2c5aa0;">
            Daftar Menu
        </div>

        <a href="{{ route('admin.menu.create') }}" class="btn-main">
                <i class="fas fa-plus-circle me-2"></i>Tambah Menu
            </a>
        </div>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div style="
            background:#e9f8ee;
            border:1px solid #c7e8d1;
            padding:12px 14px;
            border-radius:8px;
            margin-bottom:16px;
            font-size:14px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- CARD GRID -->
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

                <div class="menu-price">
                    Harga: {{ $m->price ?? '-' }}
                </div>

                <div class="actions">
                    <a href="#">View</a>

                    <a href="{{ route('admin.menu.edit', $m->id) }}">
                        Edit
                    </a>

                    <form action="{{ route('admin.menu.destroy', $m->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#"
                           class="delete-link"
                           onclick="event.preventDefault(); if(confirm('Hapus menu?')) this.closest('form').submit();">
                            Delete
                        </a>
                    </form>
                </div>

            </div>
        @empty
            <div style="font-size:15px; margin-top:10px;">Tidak ada menu. Tambahkan item baru.</div>
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
