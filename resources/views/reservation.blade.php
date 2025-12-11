@extends('layouts.main')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 position-relative overlay-bottom">
    <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5" style="min-height: 400px">
        <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">{{ $page->title ?? 'Reservasi' }}</h1>
        <div class="d-inline-flex mb-lg-5">
            @if(!empty($page->excerpt))
                <p class="text-white text-center mb-0">{{ $page->excerpt }}</p>
            @endif
        </div>
    </div>
</div>  
<!-- Page Header End -->

<style>
/* =========================== */
/* CARD FORM – clean & modern  */
/* =========================== */
.reservation-card {
    width: 100%;
    max-width: 950px;
    margin: 0 auto;
    border-radius: 14px;
    padding: 25px 40px !important;
    background: #e0e1e2ff;
    border: 1px solid #dfe7ff;
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}

/* FORM INPUT LEBIH RAPI */
.form-control-lg {
    padding: 12px 14px !important;
    font-size: 1rem !important;
    border-radius: 10px;
}

/* Hilangkan ruang berlebih antar input */
.mb-3, .mb-4 {
    margin-bottom: 14px !important;
}

/* Checkbox kecil */
.form-check-input {
    transform: scale(0.88);
    margin-top: 4px;
}

/* Judul form */
.card-title {
    font-size: 26px;
    font-weight: 700;
    color: #1a2b6d;
}

/* Button kembali normal */
.erth-btn-primary {
    background: #162fb9ff !important;
    color: white !important;
    border-radius: 10px;
    padding: 12px 18px;
    font-size: 1rem;
    font-weight: 600;
    transition: 0.2s;
}

.erth-btn-primary:hover {
    background: #001fad !important;
}

/* Biar form tidak terlalu tinggi */
.card-body {
    padding: 32px !important;
}

/* FORM FULL WIDTH */
.col-lg-6 {
    max-width: 950px !important;
}

/* Required star */
.required-star {
    color: red;
    font-weight: bold;
}

/* ========================================== */
/*      MODAL / POPUP RAPI & ELEGAN           */
/* ========================================== */
.modal-custom {
    border-radius: 18px;
    border: none;
    overflow: hidden;
    background: #ffffff !important;
    box-shadow: 0px 10px 30px rgba(0,0,0,0.25);
}

.modal-custom-header {
    background: #1a3cff;
    color: #fff;
    padding: 18px 25px;
    font-size: 20px;
    font-weight: 700;
}

.modal-body {
    padding: 25px 30px !important;
}

/* Input di modal */
.modal-body .form-control {
    border-radius: 10px;
    padding: 10px 12px;
}

/* Button modal */
.modal-body .btn {
    padding: 12px;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 700;
}

/* ================================ */
/*    RESERVATION SUCCESS ALERT     */
/* ================================ */
.reservation-alert {
    background: #e8f9ee;
    border: 1px solid #b6e8c5;
    padding: 14px 22px;
    border-radius: 12px;
    max-width: 700px;
    margin: 20px auto 40px auto;
    font-size: 15px;
    color: #1a3b23;
    font-weight: 500;
    display: flex;
    gap: 15px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.06);
    animation: fadeIn 0.4s ease;
}

/* WA BUTTON */
.wa-btn {
    background: #0066ff;
    color: white;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none !important;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    transition: 0.25s;
}

.wa-btn:hover {
    background: #0049c9;
}

/* Fade-in animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>



<div class="container-fluid py-5">
    <div class="container">
        
        @if(session('success'))
            <div class="reservation-alert">
                <div class="reservation-text">
                    {{ session('success') }}
                </div>

                @php
                    $waData = session('reservation_wa');
                @endphp

                @if(!empty($waData))
                    @php
                        $waNumber = '6281216615085';
                        $waText = "Halo, saya ingin konfirmasi reservasi:%0A"
                            . "Nama: {$waData['name']}%0A"
                            . "Ruangan: " . strtoupper($waData['room_type']) . "%0A"
                            . "Tanggal: {$waData['date']}%0A"
                            . "Waktu: {$waData['time']}%0A"
                            . "Detail: {$waData['person_detail']}";
                    @endphp

                    <a href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" target="_blank" class="wa-btn">
                        👉 Kirim ke WhatsApp
                    </a>
                @endif
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="section-title text-center mb-5">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Pesan Sekarang</h4>
            <h1 class="display-4">{{ $page->subtitle ?? 'Reservasi Tempat Anda' }}</h1>
        </div>

        <div class="row justify-content-center">
            <!-- FORM RESERVASI -->
            <div class="col-lg-6">
<div class="card shadow-sm border-0 reservation-card">
    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Formulir Reservasi</h3>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form id="reservation-form" action="{{ route('reservation.store') }}" method="POST">
                            @csrf

                            <!-- REQUIRED FIELDS WITH STAR -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="required-star">*</span></label>
                                <input type="text" name="name" class="form-control form-control-lg" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email <span class="required-star">*</span></label>
                                <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">No. Telepon <span class="required-star">*</span></label>
                                <input type="text" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tipe Ruangan <span class="required-star">*</span></label>
                                <select name="room_type" class="form-control form-control-lg" required>
                                    <option value="">Pilih Ruangan</option>
                                    <option value="vip">Ruang VIP</option>
                                    <option value="workspace">Workspace</option>
                                    <option value="karaoke">Ruang Karaoke</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Tanggal <span class="required-star">*</span></label>
                                <input type="date" name="date" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Jam <span class="required-star">*</span></label>
                                <input type="time" name="time" class="form-control form-control-lg" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Durasi (menit) <span class="required-star">*</span></label>
                                <input type="number" name="duration" class="form-control" min="15" max="1440" value="{{ old('duration',60) }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Jumlah Orang / Keterangan <span class="required-star">*</span></label>
                                <input type="text" name="person_detail" class="form-control form-control-lg" required>
                            </div>

                            <!-- ============================= -->
                            <!-- NEW: CHECKBOX WAJIB -->
                            <!-- ============================= -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="agree" required>
                                <label class="form-check-label" for="agree">
                                    Saya setuju dengan syarat & ketentuan reservasi <span class="required-star">*</span>
                                </label>
                            </div>

                            <button type="submit" class="btn erth-btn-primary btn-lg w-100">
                                <i class="fas fa-check"></i> Pesan Sekarang
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reservation Section End -->

<!-- Room Selection Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container">

        <style>
            .room-card {
                border-radius: 18px;
                overflow: hidden;
                min-height: 420px; /* PERBESAR KARTU */
                background-size: cover;
                background-position: center;
                position: relative;
                box-shadow: 0 5px 18px rgba(0,0,0,0.15);
            }

            .room-card-overlay {
                position: absolute;
                inset: 0;
                background: rgba(255,255,255,0.88);
                padding: 30px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
            }

            .room-title {
                font-size: 32px;         /* PERBESAR JUDUL */
                font-weight: 800;
                color: #1f3c88;
                margin-bottom: 10px;
            }

            .room-meta {
                font-size: 16px;
                color: #6c757d;
                margin-bottom: 15px;
            }

            .room-features-list {
                font-size: 15px;
                color: #1f3c88;
                margin-bottom: 25px;
                list-style: none;
                padding-left: 0;
            }
            .room-features-list li::before {
                content: "✓ ";
                color: #1f3c88;
                font-weight: bold;
            }

            .room-actions .btn {
                width: 100%;
                padding: 12px;
                font-size: 18px;
                font-weight: 600;
                border-radius: 10px;
            }
        </style>

        <div class="section-title text-center mb-5">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Pilih Ruangan</h4>
            <h1 class="display-4">Fasilitas Kami</h1>
        </div>

        <div class="row g-4">

            <!-- VIP ROOM -->
            <div class="col-md-4">
                <div class="room-card" style="background-image: url('/img/sample_vip.jpg')">
                    <div class="room-card-overlay">

                        <div class="room-title align-items-center fw-semibold">Ruang VIP</div>
                        <div class="room-meta">Kapasitas 8–12 orang • Private & nyaman</div>

                        <ul class="room-features-list">
                            <li>AC & Ruangan Full Soundproof</li>
                            <li>Smart TV 65 inch</li>
                            <li>Sofa premium & meja besar</li>
                            <li>Private Bathroom</li>
                            <li>Wi-Fi super cepat</li>
                            <li>Lighting ambience premium</li>
                        </ul>

                        <div class="room-actions">
                            @if($booked['vip'])
                                <button class="btn btn-outline-secondary" disabled>❌ Sudah Dibooking Hari Ini</button>
                            @else
                                <a href="#reservation-form" class="btn erth-btn-primary">Pesan Ruang VIP</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <!-- WORKSPACE -->
            <div class="col-md-4">
                <div class="room-card" style="background-image: url('/img/sample_workspace.jpg')">
                    <div class="room-card-overlay">

                        <div class="room-title fw-semibold">Workspace</div>
                        <div class="room-meta">Ideal untuk meeting, bekerja, atau belajar</div>

                        <ul class="room-features-list">
                            <li>Wi-Fi Fiber 100 Mbps</li>
                            <li>Power outlet di setiap meja</li>
                            <li>Kursi ergonomis & meja panjang</li>
                            <li>Whiteboard & marker</li>
                            <li>Area tenang & nyaman</li>
                            <li>Free Coffee Refill*</li>
                            </ul>

                        <div class="room-actions">
                            @if($booked['workspace'])
                                <button class="btn btn-outline-secondary" disabled>❌ Sudah Dibooking Hari Ini</button>
                            @else
                                <a href="#reservation-form" class="btn erth-btn-primary">Pesan Workspace</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

            <!-- KARAOKE ROOM -->
            <div class="col-md-4">
                <div class="room-card" style="background-image: url('/img/sample_karaoke.jpg')">
                    <div class="room-card-overlay">

                        <div class="room-title fw-semibold">Ruang Karaoke</div>
                        <div class="room-meta">Kapasitas 6–10 orang • Hiburan keluarga & teman</div>

                        <ul class="room-features-list">
                            <li>Audio system profesional</li>
                            <li>2 Wireless Microphone</li>
                            <li>Smart TV 55 inch</li>
                            <li>Playlist lagu lengkap & update</li>
                            <li>Lighting RGB ambience</li>
                            <li>Sofa besar & meja nyaman</li>
                        </ul>

                        <div class="room-actions">
                            @if($booked['karaoke'])
                                <button class="btn btn-outline-secondary" disabled>❌ Sudah Dibooking Hari Ini</button>
                            @else
                                <a href="#reservation-form" class="btn erth-btn-primary">Pesan Karaoke</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Room Selection End -->

<!-- ========================= -->
<!-- MODAL VIP -->
<!-- ========================= -->
<div class="modal fade" id="modalVIP" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modal-custom">

      <div class="modal-custom-header">
        <h5 class="modal-title">Reservasi Ruang VIP</h5>
      </div>

      <div class="modal-body p-4">

        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf

            <input type="hidden" name="room_type" value="vip">

            <label>Nama Lengkap <span class="required-star">*</span></label>
            <input type="text" class="form-control mb-3" name="name" required>

            <label>Email <span class="required-star">*</span></label>
            <input type="email" class="form-control mb-3" name="email" required>

            <label>No. WhatsApp / Telepon <span class="required-star">*</span></label>
            <input type="text" class="form-control mb-3" name="phone" required>

            <label>Tanggal <span class="required-star">*</span></label>
            <input type="date" class="form-control mb-3" name="date" required>

            <label>Waktu <span class="required-star">*</span></label>
            <input type="time" class="form-control mb-3" name="time" required>

            <label>Jumlah Orang / Catatan <span class="required-star">*</span></label>
            <textarea class="form-control mb-3" name="person_detail" rows="3" required></textarea>

            <!-- CHECKBOX WAJIB JUGA DI MODAL -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" required>
                <label class="form-check-label">Saya setuju dengan syarat & ketentuan <span class="required-star">*</span></label>
            </div>

            <button type="submit" class="btn erth-btn-primary w-100">
                Kirim Reservasi VIP
            </button>

        </form>

      </div>

    </div>
  </div>
</div>


@endsection