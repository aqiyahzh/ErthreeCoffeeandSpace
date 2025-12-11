@extends('layouts.main')

@section('content')

<!-- Tambah CSS yang mirip gaya Testimoni agar styling muncul -->
<style>
    /* Section Title */
    .section-title h4 {
        letter-spacing: 5px;
        font-weight: 700;
        color: #1f3c88;
    }

    .section-title h2,
    .section-title h1 {
        font-weight: 800;
        color: #1f3c88;
    }

    /* About text */
    .about-section p {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #333;
        margin-bottom: 18px;
    }

    /* Image styling */
    .about-img {
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        object-fit: cover;
    }

    /* Team Card */
    .team-card {
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: .25s ease;
    }

    .team-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.15);
    }

    .team-card img {
        height: 300px;
        object-fit: cover;
    }

    .team-card h5 {
        font-weight: 700;
        color: #1f3c88;
    }
</style>


<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Tentang Kami</h1>
    </div>
</div>
<!-- Page Header End -->


<!-- About Section -->
@if(isset($page) && $page->content)
<div class="container-fluid py-5 about-section">
    <div class="container">
        <div class="section-title">
            <h4 class="text-primary text-uppercase">Tentang Kami</h4>
            <h2 class="display-4">Melayani Sejak 2023</h2>
        </div>

        {!! $page->content !!}
    </div>
</div>

@else

<div class="container-fluid py-5 about-section">
    <div class="container">

        <div class="section-title">
            <h4 class="text-primary text-uppercase">Tentang Kami</h4>
            <h2 class="display-4">Melayani Sejak 2023</h2>
        </div>

        <div class="row">

            <div class="col-lg-4 py-0 py-lg-5">
                <h1 class="mb-3" style="color:#1f3c88; font-weight:800;">Cerita Kami</h1>
                <p>Brand ini bermula pada Agustus 2023... </p>
                <a href="{{ route('about') }}" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">
                    Selengkapnya
                </a>
            </div>

            <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 about-img" 
                         src="{{ asset('img/about.png') }}">
                </div>
            </div>

            <div class="col-lg-4 py-0 py-lg-5">
                <h1 class="mb-3" style="color:#1f3c88; font-weight:800;">Visi dan Misi Kami</h1>
                <p>Menjadi brand kopi yang dikenal...</p>

                <h6 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Menggunakan biji kopi specialty grade.</h6>
                <h6 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Pelayanan ramah dan konsisten.</h6>

                <a href="{{ route('about') }}" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">
                    Selengkapnya
                </a>
            </div>

        </div>
    </div>
</div>

@endif


<!-- Team Section -->
<div class="container-fluid py-5 bg-light">
    <div class="container">

        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase">Our Team</h4>
            <h1 class="display-4">Owner & Staff ERTHREE</h1>
        </div>

        <div class="row g-4 justify-content-center">

            @forelse($staff as $s)
            <div class="col-lg-3 col-md-6">
                <div class="team-card">

                    @if($s->photo)
                        <img src="{{ asset('uploads/staff/'.$s->photo) }}" class="w-100">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height:300px;">
                            <i class="fas fa-user fa-5x text-muted"></i>
                        </div>
                    @endif

                    <div class="p-3 text-center">
                        <h5 class="mb-1">{{ $s->name }}</h5>
                        <p class="text-muted">{{ $s->position }}</p>
                    </div>

                </div>
            </div>

            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Belum ada data staff</p>
            </div>
            @endforelse

        </div>
    </div>
</div>

@endsection
