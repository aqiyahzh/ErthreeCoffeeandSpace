@extends('layouts.main')

@section('content')

<!DOCTYPE html>
<html lang="en">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<head>
    <meta charset="utf-8">
    <title>ERTHREE Coffee and Space</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.min.css" rel="stylesheet">
</head>

<style>
    /* Bungkus tiap service menjadi card */
    .service-card {
        background: #d8d9daff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.08);
        margin-bottom: 40px;
        transition: .3s ease;
    }

    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(0,0,0,0.12);
    }

    /* Atur gambar agar tidak terlalu tinggi */
    .service-card img {
        height: 260px !important;
        border-radius: 12px;
    }

    /* Atur ikon dan teks */
    .service-text-box {
        background: #f8f9fc;
        padding: 18px 22px;
        border-radius: 12px;
    }

    /* Untuk HP: susunan tetap rapi */
    @media (max-width: 768px) {
        .service-card img {
            height: 200px !important;
        }
    }
</style>

<body>


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">{{ $page->title ?? 'Servis' }}</h1>
            <div class="d-inline-flex mb-lg-5">
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container py-5">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Layanan Kami</h4>
            <h2 class="display-4">Service Terbaik Untuk Anda</h2>
        </div>

        @forelse($services as $service)
<div class="row align-items-center mb-5 service-card">

            <!-- IMAGE LEFT -->
            <div class="col-lg-6 col-md-6 mb-3 mb-md-0">
                @if($service->image)
                <img src="/uploads/service/{{ $service->image }}"
                    class="img-fluid rounded"
                    style="width:100%; height:350px; object-fit:cover;">
                @else
                <img src="/img/default-service.jpg"
                    class="img-fluid rounded"
                    style="width:100%; height:350px; object-fit:cover;">
                @endif
            </div>

            <!-- TEXT RIGHT -->
            <div class="col-lg-6 col-md-6">
                <div class="d-flex align-items-start">

                    <!-- ICON -->
                    @if($service->icon)
                    <i class="{{ $service->icon }} text-primary"
                        style="font-size: 42px; margin-right: 20px;"></i>
                    @else
                    <i class="fas fa-star text-primary"
                        style="font-size: 42px; margin-right: 20px;"></i>
                    @endif

                    <div>
                        <!-- TITLE dari admin -->
                        <h3 class="fw-bold text-primary">{{ $service->title }}</h3>

                        <!-- DESCRIPTION -->
                        <p class="mb-0">{{ $service->description }}</p>
                    </div>


                </div>
            </div>

        </div>
        @empty
        <div class="text-center py-5">
            <p class="text-muted">Belum ada layanan yang ditambahkan admin.</p>
        </div>
        @endforelse

    </div>
    <!-- Service End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

@endsection