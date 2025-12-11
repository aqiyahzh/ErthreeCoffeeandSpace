    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="index.html" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">ERTHREE</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 pe-4">
            <a href="{{ route('index') }}"
               class="nav-item nav-link {{ request()->routeIs('index') ? 'active' : '' }}">
               ERTHREE
            </a>
            <a href="{{ route('about') }}"
               class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
               Tentang
            </a>
            <a href="{{ route('service') }}"
               class="nav-item nav-link {{ request()->routeIs('service') ? 'active' : '' }}">
               Servis
            </a>

            <a href="{{ route('menu') }}"
               class="nav-item nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">
               Menu
            </a>                    
<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Halaman</a>
    <div class="dropdown-menu m-0">
        <a href="{{ route('reservation') }}"
           class="dropdown-item {{ request()->routeIs('reservation') ? 'active' : '' }}">
           Reservasi
        </a>

        <a href="{{ route('testimonial') }}"
           class="dropdown-item {{ request()->routeIs('testimonial') ? 'active' : '' }}">
           Testimoni
        </a>
    </div>
</div>
            <a href="{{ route('contact') }}"
               class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
               Kontak
            </a>
                </div>
            </div>
        </nav>
    </div>