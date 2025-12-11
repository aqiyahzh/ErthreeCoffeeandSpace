@extends('layouts.main')

@section('content')

<!-- PAKSA LOAD CSS YANG SAMA DENGAN TESTIMONI -->
<link href="css/style.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Menu Kami</h1>
        <div class="d-inline-flex mb-lg-5">
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Menu Title Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu dan Harga</h4>
            <h2 class="display-4">Tersedia Menu Dengan Harga Terbaik</h2>
        </div>
    </div>
</div>
<!-- Menu Title End -->

<!-- Delivery Service Cards -->
<div class="container py-5">
    <h3 class="text-center fw-bold mb-4" style="color:#1f3c88;">
        Pesan Online
    </h3>

    <div class="row justify-content-center">

        <!-- GoFood -->
        <div class="col-md-4 col-sm-6 mb-4">
            <a href="https://gofood.co.id/samarinda/restaurant/erthree-coffee-by-narahouse-loa-bakung-92744bb9-048e-4b26-b811-0e331dd77ce0"
                target="_blank" class="text-decoration-none">
                <div class="card shadow-sm delivery-card h-100 text-center p-4">
                    <h5 class="fw-bold" style="color:#1f3c88;">
                        <i class="fa-solid fa-motorcycle me-2"></i>
                        Pesan via GoFood
                    </h5>
                </div>
            </a>
        </div>

        <!-- GrabFood -->
        <div class="col-md-4 col-sm-6 mb-4">
            <a href="https://food.grab.com/id/id/restaurant/erthree-coffee-loa-bakung-delivery/6-C6XGCXXXLFJVJA?"
                target="_blank" class="text-decoration-none">
                <div class="card shadow-sm delivery-card h-100 text-center p-4">
                    <h5 class="fw-bold" style="color:#1f3c88;">
                        <i class="fa-solid fa-utensils me-2"></i>
                        Pesan via GrabFood
                    </h5>
                </div>
            </a>
        </div>

    </div>
</div>

<style>
    .delivery-card {
        border: none;
        border-radius: 14px;
        background: #ffffff;
        transition: 0.3s ease;
        border-left: 6px solid #3f6fd1;
        box-shadow: 0 4px 10px rgba(63, 111, 209, 0.12);
    }

    .delivery-card:hover {
        transform: translateY(-6px);
        background: #f3f7ff;
        box-shadow: 0 12px 20px rgba(63, 111, 209, 0.20);
    }
</style>

<!-- Menu Section Start -->
<div class="container py-5">

    @php
        $grouped = $menus->groupBy(fn($m) => $m->category ? $m->category->name : 'Uncategorized');
    @endphp

    @foreach($grouped as $categoryName => $items)

        <!-- Judul Kategori -->
        <h1 class="fw-bold mb-5" style="color:#1f3c88;">
            {{ $categoryName }}
        </h1>

        <div class="row">

            @foreach($items as $item)
            <div class="col-lg-6 mb-5">

                <div class="d-flex align-items-start">

                    <!-- FOTO + HARGA -->
                    <div class="position-relative" style="width:110px; height:110px;">

                        @if($item->image)
                        <img src="/uploads/menu/{{ $item->image }}"
                            class="rounded-circle"
                            style="width:110px; height:110px; object-fit:cover;">
                        @else
                        <img src="/img/menu-1.png"
                            class="rounded-circle"
                            style="width:110px; height:110px; object-fit:cover;">
                        @endif

                        <!-- HARGA BULAT -->
                        <span class="position-absolute"
                            style="
                                top:-6px;
                                right:-6px;
                                background:#1f3c88;
                                color:white;
                                width:42px;
                                height:42px;
                                border-radius:50%;
                                display:flex;
                                justify-content:center;
                                align-items:center;
                                font-weight:bold;
                                font-size:14px;
                            ">
                            {{ $item->price }}
                        </span>
                    </div>

                    <!-- TEKS (JARAK FIX 30PX) -->
                    <div style="margin-left: 30px; max-width: 350px;">
                        <h4 class="fw-bold mb-1" style="color:#1f3c88; font-size:22px;">
                            {{ $item->name }}
                        </h4>

                        <p class="m-0 text-muted" style="font-size:15px; line-height:1.55;">
                            {{ $item->description ?? 'Tidak ada deskripsi.' }}
                        </p>
                    </div>

                </div>

            </div>
            @endforeach

        </div>

    @endforeach

</div>
<!-- Menu Section End -->


<!-- Book Menu Button -->
<div class="container py-4">
    <div class="w-100 d-flex justify-content-center">
        <a href="https://drive.google.com/file/d/1hisUfrRtw5icW8mYrgJxHgYcbMMIHiJT/view"
            target="_blank"
            class="book-menu-btn"
            role="button"
            aria-label="Book Menu">
            Buku Menu
        </a>
    </div>
</div>

<style>
    .book-menu-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #1f3c88;
        color: #fff;
        font-weight: 700;
        padding: 0.6rem 1.8rem;
        border-radius: 6px;
        text-decoration: none;
        border: none;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: 0.3s ease;
    }

    .book-menu-btn:hover {
        background-color: #2f4fa8;
        color: #fff;
        text-decoration: none;
    }

    @media (max-width: 576px) {
        .book-menu-btn {
            width: 100%;
        }
    }
</style>

@endsection
