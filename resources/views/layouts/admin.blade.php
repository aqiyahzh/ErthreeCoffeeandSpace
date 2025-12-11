<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - Erthree</title>

    <!-- Custom CSS -->
    <link href="/css/admin.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        body {
            background: #f4f6f9;
            overflow-x: hidden;
            font-family: 'Montserrat', sans-serif;
        }

        
        /* Sidebar */
        .admin-sidebar {
            width: 240px;
            height: 100vh;
            background: #d2d3d6ff;
            padding-top: 1.4rem;
            position: fixed;
            left: 0;
            top: 0;
            color: #3936c2ff;
            overflow-y: auto;
            overflow-x: hidden;

        }

        .admin-sidebar a {
            display: block;
            padding: 12px 20px;
            color: #2a4ba3ff;
            text-decoration: none;
            margin-bottom: 5px;
            transition: 0.2s;
            font-size: 15px;
        }

        .admin-sidebar a:hover,
        .admin-sidebar .active {
            background: rgba(255, 255, 255, 0.18);
            color: #173b72ff;
            border-radius: 8px;
        }

        .admin-main {
            margin-left: 240px;
            padding: 25px;
            min-height: 100vh;
        }

        .admin-logo img {
            width: 100%;
            max-width: 200px;
            display: block;
            margin: 0 auto 20px;
        }

    .admin-logout {
        width: 100%;
        background: #3936c2ff;
        color: #fff;
        padding: 10px 16px;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all .2s ease-in-out;
        margin-top: 10px;
    }

    .admin-logout i {
        font-size: 16px;
    }

    .admin-logout:hover {
        background: #173b72ff;
        transform: translateY(-2px);
    }
</style>

    </style>
</head>

<body>
    <div class="admin-wrapper">

        <!-- SIDEBAR -->
        <aside class="admin-sidebar">
            <div class="admin-logo">
                <img src="/img/erthree-logo.png" alt="Erthree Logo">
            </div>

            <ul class="admin-nav">
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dasbor</a></li>

                @if(Route::has('admin.carousel.index'))
                    <li><a href="{{ route('admin.carousel.index') }}" class="{{ request()->routeIs('admin.carousel.*') ? 'active' : '' }}">Korsel</a></li>
                @endif

                @if(Route::has('admin.category.index'))
                    <li><a href="{{ route('admin.category.index') }}" class="{{ request()->routeIs('admin.category.*') ? 'active' : '' }}">Kategori Menu</a></li>
                @endif

                @if(Route::has('admin.menu.index'))
                    <li><a href="{{ route('admin.menu.index') }}" class="{{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">Menu</a></li>
                @endif

                @if(Route::has('admin.testimonial.index'))
                    <li><a href="{{ route('admin.testimonial.index') }}" class="{{ request()->routeIs('admin.testimonial.*') ? 'active' : '' }}">Testimoni</a></li>
                @endif

                @if(Route::has('admin.staff.index'))
                    <li><a href="{{ route('admin.staff.index') }}" class="{{ request()->routeIs('admin.staff.*') ? 'active' : '' }}">Staff</a></li>
                @endif

                @if(Route::has('admin.service.index'))
                    <li><a href="{{ route('admin.service.index') }}" class="{{ request()->routeIs('admin.service.*') ? 'active' : '' }}">Servis</a></li>
                @endif

                @if(Route::has('admin.about.edit'))
                    <li><a href="{{ route('admin.about.edit') }}" class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">Tentang</a></li>
                @endif

                @if(Route::has('admin.contact.edit'))
                    <li><a href="{{ route('admin.contact.edit') }}" class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">Kontak</a></li>
                @endif

                @if(Route::has('admin.reservation.index'))
                    <li><a href="{{ route('admin.reservation.index') }}" class="{{ request()->routeIs('admin.reservation.*') ? 'active' : '' }}">Reservasi</a></li>
                @endif
            </ul>

<form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button class="admin-logout">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </button>
</form>
        </aside>

        <!-- CONTENT -->
        <main class="admin-main">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
