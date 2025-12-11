@extends('layouts.main')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Tentang Kami</h1>
        <div class="d-inline-flex mb-lg-5">
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- About Start -->
    <!-- About Start -->
    @if(isset($page) && $page->content)
    <div class="container-fluid py-5 about-section">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang Kami</h4>
                <h2 class="display-4">Melayani Sejak 2023</h2>
            </div>
            {!! $page->content !!}
        </div>
    </div>
    <!-- About End -->
    @else
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang Kami</h4>
                <h2 class="display-4">Melayani Sejak 2023</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Cerita Kami</h1>
                    <p>Brand ini bermula pada Agustus 2023, dari keinginan sederhana untuk menghadirkan kopi Indonesia dengan kualitas yang bisa dibanggakan. Sejak hari pertama, kami memilih untuk menggunakan biji kopi specialty grade, karena kami percaya bahwa kopi terbaik layak diperkenalkan apa adanya dengan rasa yang jernih, konsisten, dan menggambarkan potensi kopi Indonesia yang sesungguhnya.</p>
                    <a href="{{ route('about') }}" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Selengkapnya</a>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Visi dan Misi Kami</h1>
                    <p>Menjadi brand kopi yang dikenal karena kualitas produk, inovasi yang berkelanjutan, dan hospitality yang tulus, serta mampu memperkenalkan potensi terbaik kopi Indonesia kepada lebih banyak orang.</p>
                    <h6 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Menggunakan biji kopi specialty grade untuk menghadirkan rasa dan pengalaman terbaik dari kopi Indonesia.</h6>
                    <h6 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Membangun hubungan yang hangat dan berkelanjutan dengan setiap konsumen melalui pelayanan yang ramah dan konsisten.</h6>
                    <a href="{{ route('about') }}" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
    @endif

<!-- Team Section Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Team</h4>
            <h1 class="display-4">Owner & Staff ERTHREE</h1>
        </div>

        <div class="row g-4 justify-content-center">

            @forelse($staff as $s)
            <div class="col-lg-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    @if($s->photo)
                    <img src="{{ asset('uploads/staff/'.$s->photo) }}" class="card-img-top" alt="{{ $s->name }}" style="height: 300px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                        <i class="fas fa-user fa-5x text-muted"></i>
                    </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">{{ $s->name }}</h5>
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
<!-- Team Section End -->

@endsection