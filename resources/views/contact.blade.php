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

<body>


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">{{ $page->title ?? 'Kontak' }}</h1>
            <div class="d-inline-flex mb-lg-5">
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Tentang Kami Section Start -->
<div class="container-fluid py-5 about-section">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Hubungi Kami</h4>
            <h2 class="display-4">Kami Siap Membantu Anda</h2>
        </div>
    </div>
</div>
<!-- Tentang Kami Section End


    <!-- Contact Start -->
    <div class="container-fluid pt-1">
        <div class="container">

            <!-- Jam Operasional -->
            <div class="text-center mt-3 mb-5">
                <h5 class="fw-bold mb-2" style="color:#1f3c88;">🕘 Jam Operasional</h5>
                <p class="mb-0 text-dark" style="font-size:16px;">
                    Senin – Jumat: {{ $contact->weekday_hours ?? '-' }} <br>
                    Sabtu – Minggu: {{ $contact->weekend_hours ?? '-' }}
                </p>
            </div>

            <!-- Informasi Kontak -->
            <div class="row g-4 justify-content-center text-center">

                <!-- Instagram -->
                <div class="col-md-4">
                    <div class="p-4 shadow rounded bg-white h-100">
                        <i class="fab fa-2x fa-instagram text-primary mb-3"></i>
                        <h5 class="fw-bold mb-2" style="color:#1f3c88;">Instagram</h5>

                        @php
                        // Username saja, contoh: erthree.coffee
                        $igUser = $contact->instagram ?? '';
                        @endphp

                        <p class="m-0 text-dark">
                            {{ $igUser ? '@' . $igUser : '-' }}
                        </p>

                        @if(!empty($igUser))
                        <a href="https://instagram.com/{{ $igUser }}" target="_blank"
                            class="btn btn-sm btn-primary rounded-pill mt-3 px-4">
                            Kunjungi Instagram
                        </a>
                        @endif
                    </div>
                </div>


                <!-- WhatsApp -->
                <div class="col-md-4">
                    <div class="p-4 shadow rounded bg-white h-100">
                        <i class="fa fa-2x fa-phone-alt text-primary mb-3"></i>
                        <h5 class="fw-bold mb-2" style="color:#1f3c88;">Telepon / WhatsApp</h5>
                        <p class="m-0 text-dark">{{ $contact->whatsapp ?? '-' }}</p>

                        @php
                        $wa = preg_replace('/\D/', '', $contact->whatsapp ?? '');
                        @endphp

                        <a href="https://wa.me/{{ $wa }}" class="btn btn-sm btn-primary rounded-pill mt-3 px-4">
                            Chat WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-4">
                    <div class="p-4 shadow rounded bg-white h-100">
                        <i class="far fa-2x fa-envelope text-primary mb-3"></i>
                        <h5 class="fw-bold mb-2" style="color:#1f3c88;">Email</h5>

                        <p class="m-0 text-dark">{{ $contact->email ?? '-' }}</p>

                        @if(!empty($contact->email))
                        <a href="mailto:{{ $contact->email }}"
                            class="btn btn-sm btn-primary rounded-pill mt-3 px-4">
                            Kirim Email
                        </a>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Contact End -->

    <div style="margin-top: 40px;"></div>

    <!-- MAP DINAMIS -->
    <div class="w-100 m-0 p-0 mt-5">
        <iframe
            src="{{ $contact->map_url ?? '' }}"
            width="100%"
            height="500"
            style="border:0; display:block;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </div>


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