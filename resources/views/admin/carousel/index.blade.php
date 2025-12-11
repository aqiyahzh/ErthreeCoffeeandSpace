@extends('layouts.admin')
@section('content')

<style>
    :root {
        --primary-color: #2c5aa0;
        --primary-dark: #224679;
        --primary-light: #e8f0f8;
        --danger-color: #dc3545;
        --success-color: #28a745;
    }

    /* BUTTON PRIMARY */
    .btn-with-background {
        display: inline-block;
        background: var(--primary-color);
        color: white;
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        text-decoration: none;
        transition: all .3s ease;
        border: none;
    }

    .btn-with-background:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(34, 70, 121, 0.25);
    }

    /* CARD HEADER TANPA GRADASI */
    .card-header {
        background: var(--primary-color) !important;
        border: none;
        padding: 1.15rem 1.3rem;
    }

    .card-header h3 {
        color: #fff;
        font-weight: 600;
        font-size: 1.15rem;
        margin: 0;
    }

    /* TABLE HEADER */
    thead {
        background-color: var(--primary-light) !important;
    }

    thead th {
        color: var(--primary-color);
        padding: 1rem 1.25rem;
        font-weight: 600;
        text-align: center;
    }

    /* ROW HOVER */
    .table-hover tbody tr:hover {
        background-color: #f4f8ff !important;
    }

    /* IMAGE */
    .img-preview {
        width: 130px;
        height: 85px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #dfe7f3;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }

    .img-placeholder {
        width: 130px;
        height: 85px;
        border: 2px dashed #cbd5e0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b8c3d1;
        border-radius: 10px;
    }

    /* BADGE */
    .badge-order {
        background-color: var(--primary-color);
        color: white;
        padding: 0.45rem 0.75rem;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* ACTION BUTTONS */
    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.45rem 0.75rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 500;
        transition: .2s;
        text-decoration: none !important;
    }

    .btn-edit {
        background-color: var(--primary-color);
        color: white;
    }

    .btn-edit:hover {
        background-color: var(--primary-dark);
    }

    .btn-delete {
        background-color: var(--danger-color);
        color: white;
    }

    .btn-delete:hover {
        background-color: #b6202d;
    }

    /* ALERT */
    .alert-success {
        border-left: 4px solid var(--success-color);
        background-color: #eaf7ec;
        color: #2f6f3e;
    }

    /* RESPONSIVE */
    @media (max-width: 1400px) {
        .btn-action span {
            display: none;
        }
    }
</style>


<div class="container-fluid p-4" style="background-color:#f8f9fa;">
    
    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1" style="color:#2c5aa0;font-weight:600;">Kelola Carousel</h2>
            <p class="text-muted mb-0">Kelola gambar carousel pada halaman utama</p>
        </div>

        <a href="{{ route('admin.carousel.create') }}" class="btn-with-background">
            <i class="fas fa-plus-circle me-2"></i>Tambah Carousel
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- CARD TABLE -->
    <div class="card shadow-sm" style="border-radius:12px;">
        
        <div class="card-header">
            <h3 class="mb-0">
                <i class="fas fa-images me-2"></i>Daftar Carousel
            </h3>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle" style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th width="20%">Gambar</th>
                        <th width="45%">Judul</th>
                        <th width="10%">Urutan</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($carousels as $carousel)
                        <tr style="border-bottom:1px solid #e9ecef;">
                            <td class="text-center py-3">
                                @if($carousel->image)
                                    <img src="{{ asset('uploads/carousel/'.$carousel->image) }}" class="img-preview">
                                @else
                                    <div class="img-placeholder"><i class="fas fa-image fa-2x"></i></div>
                                @endif
                            </td>

                            <td class="text-center py-3">
                                <strong style="color:#2c5aa0;font-size:1rem;">
                                    {{ $carousel->title }}
                                </strong>
                            </td>

                            <td class="text-center py-3">
                                <span class="badge badge-order">{{ $carousel->order }}</span>
                            </td>

                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    
                                    <a href="{{ route('admin.carousel.edit', $carousel->id) }}"
                                       class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                        <span>Edit</span>
                                    </a>

                                    <button onclick="deleteCarousel('{{ $carousel->id }}')"
                                            class="btn-action btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Hapus</span>
                                    </button>

                                    <form id="delete-form-{{ $carousel->id }}"
                                          method="POST"
                                          action="{{ route('admin.carousel.destroy', $carousel->id) }}"
                                          style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-images fa-3x mb-3" style="color:#c4ccd8;"></i>
                                <p class="text-muted mb-0">Belum ada data carousel</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>


<script>
function deleteCarousel(id) {
    if (confirm("Hapus carousel ini? Tindakan tidak dapat dibatalkan.")) {
        document.getElementById("delete-form-" + id).submit();
    }
}
</script>

@endsection
