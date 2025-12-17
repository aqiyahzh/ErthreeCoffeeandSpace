@extends('layouts.main')

@push('styles')
<style>
    /* ================= FORM ================= */
    .form-wrapper {
        background: #e0e1e2ff;
        border-radius: 18px;
        padding: 28px 32px;
        box-shadow: 0 10px 28px rgba(0, 0, 0, .12);
        border: 1px solid #e5ebff;
    }

    .form-title {
        font-size: 24px;
        font-weight: 700;
        text-align: center;
        color: #1f3c88;
        margin-bottom: 18px;
    }

    .form-label {
        font-size: .9rem;
        font-weight: 600;
        color: #1f3c88;
        margin-bottom: 4px;
    }

    .form-control {
        border-radius: 12px;
        padding: 10px 14px;
        border: 1px solid #cdd8f7;
        font-size: .95rem;
    }

    textarea.form-control { min-height: 110px; }

    .btn-submit {
        height: 55px;
        background: linear-gradient(135deg, #2c5aa0, #4a7bc8);
        border: none;
        border-radius: 14px;
        font-size: 1.05rem;
        font-weight: 600;
        color: white;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #234a88, #3a6bb5);
    }

    .turnstile-wrapper {
        display: flex;
        justify-content: center;
        margin: 14px 0 6px;
    }

    /* ================= TESTIMONIAL CARD ================= */
    .testimonial-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        border: 1px solid #e7eaff;

        height: 320px;
        display: flex;
        flex-direction: column;
    }

    .testimonial-header {
        display: flex;
        gap: 16px;
        margin-bottom: 12px;
    }

    .testimonial-user-img {
        width: 62px;
        height: 62px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #2c5aa0;
    }

    .testimonial-name { font-weight: 700; color: #1f3c88; }
    .testimonial-date { font-size: .85rem; color: #8a8a8a; }
    .testimonial-stars { color: #fbc02d; }

    .testimonial-content {
        font-size: .95rem;
        color: #333;
        line-height: 1.55;
        margin-top: 10px;

        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        line-clamp: 4;
    }

    /* Biar card nggak kepotong saat carousel */
    .owl-carousel .owl-stage-outer { overflow: visible; }
    .owl-carousel .owl-item { padding: 15px; }
</style>
@endpush

@section('content')

<!-- PAGE HEADER -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex align-items-center justify-content-center" style="min-height:400px;">
        <h1 class="display-4 text-white text-uppercase">Testimoni</h1>
    </div>
</div>

<!-- FORM TESTIMONIAL -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="form-wrapper">
                <h3 class="form-title">Form Testimonial</h3>

                <form action="{{ route('testimonial.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating *</label>
                        <select name="rating" class="form-control" required>
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
                        <textarea name="testimonial" class="form-control" required></textarea>
                    </div>

                    <div class="turnstile-wrapper">
                        <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
                    </div>

                    <button type="submit" class="btn-submit w-100 mt-2">
                        Kirim Testimonial
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- TESTIMONIAL SLIDER -->
<div class="container-fluid py-5 bg-light">
    <div class="container">

        <div class="text-center mb-4">
            <h2 class="display-5">Kata-Kata Dari Para Pembeli</h2>
        </div>

        @if(isset($testimonials) && $testimonials->count())
            <div class="owl-carousel testimonial-carousel">
                @foreach($testimonials as $t)
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img class="testimonial-user-img"
                                 src="{{ $t->photo ? asset('uploads/testimonial/'.$t->photo) : asset('img/testimonial-1.png') }}">

                            <div>
                                <div class="testimonial-name">{{ $t->name ?? 'Anonymous' }}</div>
                                <div class="testimonial-date">{{ $t->created_at->format('d M Y') }}</div>
                                <div class="testimonial-stars">
                                    @for($i=0;$i<$t->rating;$i++) ⭐ @endfor
                                </div>
                            </div>
                        </div>

                        <p class="testimonial-content">{{ $t->content }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-muted">Belum ada testimonial.</p>
        @endif

    </div>
</div>

@endsection

@push('scripts')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
    $(document).ready(function() {
        $('.testimonial-carousel').owlCarousel({
            autoplay: true,
            smartSpeed: 900,
            margin: 25,
            dots: true,
            nav: false,
            loop: true,
            responsive: {
                0: { items: 1 },
                768: { items: 2 },
                992: { items: 3 }
            }
        });
    });
</script>
@endpush
