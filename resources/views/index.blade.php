@extends('layouts.main')

@section('content')

<!DOCTYPE html>
<html lang="en">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<head>
    <meta charset="utf-8">
    <title>ERTHREE  Coffee and Space</title>
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
    <style>
        /* Badge-style caption to improve visibility over carousel images */

        @media (max-width: 576px) {
            .caption-badge { padding: 4px 10px; font-size: 0.95rem; }
        }
    </style>
</head>

<body>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                @forelse($carousels as $index => $carousel)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img class="w-100" src="{{ asset('uploads/carousel/'.$carousel->image) }}" alt="{{ $carousel->title }}">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-white font-weight-medium m-0 caption-badge">Kami Melayani</h2>
                        <h2 class="display-2 text-white m-0">{{ $carousel->title }}</h2>
                        <h2 class="text-white m-0">SEJAK 2023</h2>
                    </div>
                </div>
                @empty
                <div class="carousel-item active">
                    <img class="w-100" src="img/carousel-1.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-white font-weight-medium m-0 caption-badge">Kami Melayani</h2>
                        <h2 class="display-2 text-white m-0">KOPI DAN MAKANAN</h2>
                        <h2 class="text-white m-0">SEJAK 2023</h2>
                    </div>
                </div>
                @endforelse
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-fluid py-5 about-section">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang Kami</h4>
                <h2 class="display-4">Melayani Sejak 2023</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Cerita Kami</h1>
                    <p>Brand ini bermula pada Agustus 2023, dari keinginan sederhana untuk menghadirkan kopi Indonesia dengan kualitas yang bisa dibanggakan. Sejak hari pertama, kami memilih untuk menggunakan biji kopi specialty grade, karena kami percaya bahwa kopi terbaik layak diperkenalkan apa adanya dengan rasa yang jernih, konsisten, dan menggambarkan potensi kopi Indonesia yang sesungguhnya.</p>
                    <a href="{{ route('about') }}" class="btn btn-secondary font-weight-bold py-2 px-4 mt-4">Selengkapnya</a>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/about.png" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Visi dan Misi Kami</h1>
                    <p>Menjadi brand kopi yang dikenal karena kualitas produk, inovasi yang berkelanjutan, dan hospitality yang tulus, serta mampu memperkenalkan potensi terbaik kopi Indonesia kepada lebih banyak orang.</p>
                    <h6 class="mb-2"><i class="fa fa-check text-primary mr-3"></i>Menggunakan biji kopi specialty grade untuk menghadirkan rasa dan pengalaman terbaik dari kopi Indonesia.</h6>
                    <h6 class="mb-2"><i class="fa fa-check text-primary mr-3"></i>Membangun hubungan yang hangat dan berkelanjutan dengan setiap konsumen melalui pelayanan yang ramah dan konsisten.</h6>
                    <a href="{{ route('about') }}" class="btn btn-secondary font-weight-bold py-2 px-4 mt-2">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-fluid pt-5 px-0">

        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Pelayanan Kami</h4>
                <h2 class="display-4">Kami Menyediakan Pelayanan Terbaik</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="img/service-1.png" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-truck service-icon" style="color: #ffffff;"></i>Layanan yang Cepat</h4>
                            <p class="m-0">Kami menyediakan layanan yang cepat agar pelanggan bisa menikmati kopi dan menu kami dalam kondisi terbaik. Setiap pesanan diproses dengan sigap sehingga sampai tepat waktu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="img/service-2.png" alt="">
                        </div>

                        <div class="col-sm-7">
                            <h4><i class="fa fa-coffee service-icon" style="color: #ffffff;"></i>Biji Kopi Berkualitas</h4>
                            <p class="m-0">Kami selalu menggunakan biji kopi specialty grade yang diproses secara segar. Tujuannya sederhana menghadirkan rasa kopi Indonesia yang jernih, konsisten, dan berkualitas di setiap cangkir.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="img/service-3.jpg" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-award service-icon" style="color: #ffffff;"></i>Kualitas Kopi Terbaik</h4>
                            <p class="m-0">Setiap minuman yang kami sajikan dibuat penuh perhatian mulai dari pemilihan bahan baku, metode penyeduhan, hingga penyajian. Kami percaya bahwa kualitas adalah kunci untuk memberikan pengalaman terbaik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-5">
                    <div class="row align-items-center">
                        <div class="col-sm-5">
                            <img class="img-fluid mb-3 mb-sm-0" src="img/service-4.jpg" alt="">
                        </div>
                        <div class="col-sm-7">
                            <h4><i class="fa fa-table service-icon" style="color: #ffffff;"></i>Reservasi Online</h4>
                            <p class="m-0">Untuk kenyamanan Anda, kami menyediakan layanan pemesanan meja secara online. Cukup lakukan reservasi melalui platform kami, dan Anda bisa datang tanpa perlu khawatir kehabisan tempat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Menu Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu dan Harga</h4>
            <h2 class="display-4">Tersedia Menu Dengan Harga Terbaik</h2>
        </div>


        
            @if(!empty($menu_categories) && $menu_categories->count())
            @php
                $left = $menu_categories->get(0) ?? null;
                $right = $menu_categories->get(1) ?? null;
            @endphp

            <div class="row">
                <div class="col-lg-6">
                    @if($left)
                        <h1 class="mb-4">{{ $left->name }}</h1>

                        @foreach($left->menus->take(3) as $item)
                            <div class="row align-items-center mb-4">
                                <div class="col-4 col-sm-3">
                                    @if($item->image)
                                        <img class="menu-img-circle mb-3 mb-sm-0" src="{{ asset('uploads/menu/'.$item->image) }}" alt="{{ $item->name }}">
                                    @else
                                        <img class="menu-img-circle mb-3 mb-sm-0" src="img/menu-1.png" alt="{{ $item->name }}">
                                    @endif
                                    <h5 class="menu-price" style="color: #ffffff;">{{ $item->price }}</h5>
                                </div>
                                <div class="col-8 col-sm-9">
                                    <h4>{{ $item->name }}</h4>
                                    <p class="m-0">{{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>


                <div class="col-lg-6">
                    @if($right)
                        <h1 class="mb-4">{{ $right->name }}</h1>
                        @foreach($right->menus->take(3) as $item)
                            <div class="row align-items-center mb-4">
                                <div class="col-4 col-sm-3">
                                    @if($item->image)
                                        <img class="menu-img-circle mb-3 mb-sm-0" src="{{ asset('uploads/menu/'.$item->image) }}" alt="{{ $item->name }}">
                                    @else
                                        <img class="menu-img-circle mb-3 mb-sm-0" src="img/menu-4.png" alt="{{ $item->name }}">
                                    @endif
                                    <h5 class="menu-price" style="color: #ffffff;">{{ $item->price }}</h5>
                                </div>
                                <div class="col-8 col-sm-9">
                                    <h4>{{ $item->name }}</h4>
                                    <p class="m-0">{{ $item->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            @else
            <div class="row">
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Menu sedang kosong. <a href="{{ route('menu') }}">Lihat semua menu</a></p>
                </div>
            </div>
            @endif

        <div class="w-100 d-flex justify-content-center mt-3 mb-4">
            <a href="{{ route('menu') }}" class="btn btn-secondary font-weight-bold py-2 px-4">
                Selengkapnya
            </a>
        </div>
    </div>
</div>

    <!-- Menu End -->


    <!-- Reservation Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="section-title text-center">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Pesan Sekarang</h4>
            <h2 class="display-4">Reservasi Tempat Anda</h2>
        </div>
    </div>
</div>

<!-- Reservation Category Section Start -->
<div class="container my-5">

    <style>
        .menu-img-circle {
    width: 100%;
    aspect-ratio: 1 / 1; /* Membuat gambar selalu kotak */
    object-fit: cover;   /* Crop rapi tanpa melebar */
    border-radius: 50%;  /* Membuat lingkaran */
}

        .res-room-card {
            border-radius: 18px;
            overflow: hidden;
            min-height: 430px;
            background-size: cover;
            background-position: center;
            position: relative;
            box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        }

        .res-overlay {
            position: absolute;
            inset: 0;
            background: rgba(255,255,255,0.88);
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .res-title {
            font-size: 30px;
            font-weight: 800;
            color: #1f3c88;
            margin-bottom: 10px;
        }

        .res-meta {
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .res-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 25px;
            color: #1f3c88;
            font-size: 15px;
        }
        .res-list li:before {
            content: "✓ ";
            font-weight: bold;
            color: #1f3c88;
        }

        .res-btn {
            width: 100%;
            padding: 12px;
            font-size: 17px;
            font-weight: 600;
            border-radius: 10px;
        }

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
    </style>

    <div class="row g-4">

        <!-- VIP -->
        <div class="col-md-4">
            <div class="res-room-card" style="background-image:url('/img/sample_vip.jpg')">
                <div class="res-overlay">
                    <i class="fa fa-star fa-3x mb-3"></i>
                <h4 class="mb-3">RUANG VIP</h4>
                    <div class="res-meta">Kapasitas 8–12 orang • Private & Nyaman</div>

                    <ul class="res-list">
                        <li>Smart TV 65 inch</li>
                        <li>Sofa premium & meja besar</li>
                        <li>AC & soundproof</li>
                        <li>Wi-Fi super cepat</li>
                        <li>Private bathroom</li>
                    </ul>

                    <a href="{{ route('reservation') }}" class="btn btn-primary res-btn">
    Pesan Ruang VIP
</a>
                </div>
            </div>
        </div>

        <!-- WORKSPACE -->
        <div class="col-md-4">
            <div class="res-room-card" style="background-image:url('/img/sample_workspace.jpg')">
                <div class="res-overlay">
                    <i class="fa fa-briefcase fa-3x mb-3"></i>
                <h4 class="mb-3">WORKSPACE</h4>
                    <div class="res-meta">Cocok untuk meeting & bekerja</div>

                    <ul class="res-list">
                        <li>Wi-Fi 100 Mbps</li>
                        <li>Colokan tiap meja</li>
                        <li>Kursi ergonomis</li>
                        <li>Whiteboard & marker</li>
                        <li>Area tenang & fokus</li>
                    </ul>

                    <a href="{{ route('reservation') }}" class="btn btn-primary res-btn">
    Pesan Ruang Workspace
</a>
                </div>
            </div>
        </div>

        <!-- KARAOKE -->
        <div class="col-md-4">
            <div class="res-room-card" style="background-image:url('/img/sample_karaoke.jpg')">
                <div class="res-overlay">
                    <i class="fa fa-microphone fa-3x mb-3"></i>
                <h4 class="mb-3">RUANG KARAOKE</h4>
                    <div class="res-meta">Hiburan keluarga & teman</div>

                    <ul class="res-list">
                        <li>2 wireless microphone</li>
                        <li>Smart TV 55 inch</li>
                        <li>Playlist lagu lengkap</li>
                        <li>Audio premium</li>
                        <li>Lighting RGB ambience</li>
                    </ul>

                    <a href="{{ route('reservation') }}" class="btn btn-primary res-btn">
    Pesan Ruang Karaoke
</a>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- Reservation Category Section End -->


<!-- ========================= -->
<!-- MODAL VIP -->
<!-- ========================= -->
<div class="modal fade" id="modalVIP" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Reservasi Ruang VIP</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form id="formVIP">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="vip_name" required>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" id="vip_date" required>
            </div>

            <div class="form-group">
                <label>Waktu</label>
                <input type="time" class="form-control" id="vip_time" required>
            </div>

            <div class="form-group">
                <label>Jumlah Orang</label>
                <input type="number" class="form-control" id="vip_person" required>
            </div>
        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" onclick="sendWhatsApp(event,'VIP Room')">Kirim WhatsApp</button>
      </div>
    </div>
  </div>
</div>


<!-- ========================= -->
<!-- MODAL WORKSPACE -->
<!-- ========================= -->
<div class="modal fade" id="modalWorkspace" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Reservasi Workspace</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">

        <form id="formWorkspace">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="ws_name" required>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" id="ws_date" required>
            </div>

            <div class="form-group">
                <label>Waktu</label>
                <input type="time" class="form-control" id="ws_time" required>
            </div>

            <div class="form-group">
                <label>Jenis Workspace</label>
                <select class="form-control" id="ws_person">
                    <option>Ruang Meeting</option>
                    <option>No Smooking Area</option>
                    <option>Smooking Area</option>
                </select>
            </div>
        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" onclick="sendWhatsApp(event,'Workspace')">Kirim WhatsApp</button>
      </div>
    </div>
  </div>
</div>


<!-- ========================= -->
<!-- MODAL KARAOKE -->
<!-- ========================= -->
<div class="modal fade" id="modalKaraoke" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Reservasi Ruang Karaoke</h5>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

        <form id="formKaraoke">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" id="kr_name" required>
            </div>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" id="kr_date" required>
            </div>

            <div class="form-group">
                <label>Waktu</label>
                <input type="time" class="form-control" id="kr_time" required>
            </div>

            <div class="form-group">
                <label>Durasi (jam)</label>
                <input type="number" class="form-control" id="kr_person" required>
            </div>
        </form>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" onclick="sendWhatsApp(event,'Karaoke Room')">Kirim WhatsApp</button>
      </div>

    </div>
  </div>
</div>



<!-- ========================= -->
<!-- SCRIPT WHATSAPP UNIVERSAL -->
<!-- ========================= -->
<script>
function sendWhatsApp(event, roomType) {
    event.preventDefault();

    let phone = "6282159037025"; // NOMOR SUDAH BENAR

    // prefix ID untuk tiap tipe ruangan
    let prefix =
        roomType === "VIP Room" ? "vip" :
        roomType === "Workspace" ? "ws" : "kr";

    let name = document.getElementById(prefix + "_name").value;
    let date = document.getElementById(prefix + "_date").value;
    let time = document.getElementById(prefix + "_time").value;
    let person = document.getElementById(prefix + "_person").value;

    let message =
`Halo, saya ingin melakukan reservasi:
Room: ${roomType}
Nama: ${name}
Tanggal: ${date}
Waktu: ${time}
Detail: ${person}

Terima kasih.`;

    let url =
        "https://wa.me/" +
        phone +
        "?text=" +
        encodeURIComponent(message);

    window.open(url, "_blank");
}
</script>
    <!-- Reservation End -->


    <!-- Testimonial Start -->
<div class="container-fluid py-5 bg-light">
    <div class="container">

        <div class="section-title text-center mb-4">
            <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimoni</h4>
            <h2 class="display-4">Kata-Kata Dari Para Pembeli</h2>
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
    <!-- Testimonial End -->




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