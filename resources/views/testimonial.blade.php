@extends('layouts.main')

@section('content')

<!DOCTYPE html>
<html lang="en">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<head>
    <meta charset="utf-8">
    <title>ERTHREE Coffee and Space</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Main Style -->
    <link href="css/style.min.css" rel="stylesheet">

<style>
/* ============================================================
   FORM CARD
============================================================ */
.erth-card {
    border: none;
    border-radius: 14px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.12);
    overflow: hidden;
    background: #ffffff;
    margin-bottom: 25px;
}
.erth-card-header {
    background: linear-gradient(135deg, #2c5aa0 0%, #4a7bc8 100%);
    padding: 1.3rem 1.5rem;
    color: #fff;
}
.erth-card-body {
    padding: 1.8rem;
}

/* ============================================================
   TESTIMONIAL CARD LIST (NEW MODERN UI)
============================================================ */
.testimonial-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 22px;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    border: 1px solid #e7eaff;
    transition: 0.25s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 26px rgba(0,0,0,0.12);
}

.testimonial-user-img {
    width: 62px !important;
    height: 62px !important;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #2c5aa0;
    flex-shrink: 0;
}

.testimonial-header {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 14px;
}

.testimonial-name {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1f3c88;
    margin-bottom: 3px;
}

.testimonial-date {
    font-size: 0.85rem;
    color: #8a8a8a;
}

.testimonial-stars {
    color: #fbc02d;
    font-size: 1rem;
}

.testimonial-content {
    font-size: 0.97rem;
    color: #333;
    line-height: 1.55;
    margin-top: 10px;
    flex-grow: 1;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    display: block;
}
.form-wrapper {
    background: #e0e1e2ff;
    border-radius: 18px;
    padding: 35px 40px;
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    border: 1px solid #e5ebff;
}

.form-title {
    font-size: 28px;
    font-weight: 700;
    text-align: center;
    color: #1f3c88;
    margin-bottom: 25px;
}

.form-label {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1f3c88;
    margin-bottom: 6px;
}

.form-control {
    border-radius: 12px;
    padding: 12px 16px;
    border: 1px solid #cdd8f7;
    transition: .25s ease;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #2c5aa0;
    box-shadow: 0 0 0 .18rem rgba(44,90,160,0.25);
}

/* Tombol submit */
.btn-submit {
    height: 55px;
    background: linear-gradient(135deg, #2c5aa0, #4a7bc8);
    border: none;
    border-radius: 14px;
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    transition: 0.3s ease;
}

.btn-submit:hover {
    background: linear-gradient(135deg, #234a88, #3a6bb5);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 576px) {
    .form-wrapper {
        padding: 25px 22px;
    }
}
</style>

</head>

<body>

<!-- ============================================================
     PAGE HEADER
============================================================ -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px;">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Testimoni</h1>
    </div>
</div>

<!-- ============================================================
     FORM INPUT TESTIMONIAL (STYLE BARU)
============================================================ -->
<div class="container-fluid py-5">
    <div class="container">

        <div class="section-title text-center mb-5">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h4>
            <h1 class="display-4">Tulis Testimonial Anda</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="form-wrapper">
                    <h3 class="form-title">Form Testimonial</h3>

                    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rating *</label>
                            <select class="form-control" name="rating" required>
                                <option value="">Pilih Rating</option>
                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                <option value="3">⭐⭐⭐ (3)</option>
                                <option value="2">⭐⭐ (2)</option>
                                <option value="1">⭐ (1)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Testimonial *</label>
                            <textarea class="form-control" rows="5" name="testimonial" required></textarea>
                        </div>

                        <button class="btn-submit w-100 mt-2" type="submit">
                            Kirim Testimonial
                        </button>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- ============================================================
     TESTIMONIAL LIST (CARD)
============================================================ -->
<div class="container-fluid py-5 bg-light">
    <div class="container">

        <div class="section-title text-center mb-4">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimoni</h4>
            <h2 class="display-5">Kata-Kata Dari Para Pembeli</h2>
        </div>

        @if(isset($testimonials) && $testimonials->count())

        <div class="row g-4">
            @foreach($testimonials as $t)
            <div class="col-12 col-md-6 col-lg-4 mb-4">

                <div class="testimonial-card">

                    <div class="testimonial-header">
                        @if($t->photo)
                            <img class="testimonial-user-img" src="/uploads/testimonial/{{ $t->photo }}">
                        @else
                            <img class="testimonial-user-img" src="img/testimonial-1.png">
                        @endif

                        <div>
                            <div class="testimonial-name">{{ $t->name ?? 'Anonymous' }}</div>
                            <div class="testimonial-date">{{ $t->created_at->format('d M Y') }}</div>

                            <div class="testimonial-stars">
                                @for ($i = 0; $i < $t->rating; $i++)
                                    ⭐
                                @endfor
                            </div>
                        </div>
                    </div>

                    <p class="testimonial-content">{{ $t->content }}</p>

                </div>

            </div>
            @endforeach
        </div>

        @else
        <div class="erth-card p-4 text-center" style="border-radius:14px;">
            <p class="m-0 text-muted">Belum ada testimonial.</p>
        </div>
        @endif

    </div>
</div>

<!-- BACK TO TOP -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
    <i class="fa fa-angle-double-up"></i>
</a>

</body>
</html>

@endsection
