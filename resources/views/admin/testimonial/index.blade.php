@extends('layouts.admin')

@section('content')

<div class="container-fluid p-4" style="background-color: #f8f9fa;">

    <!-- Header -->
    <div class="mb-4">
        <h2 class="mb-1" style="color: #2c5aa0; font-weight: 700;">Testimoni</h2>
        <p class="text-muted">Kelola testimoni pengunjung website</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-left: 4px solid #28a745;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Card -->
    <div class="card shadow-sm" style="border: none; border-radius: 6px; overflow: hidden;">
        
        <!-- Header Card -->
        <div class="card-header" 
             style="background:#2c5aa0; padding: 1.1rem 1.25rem; border: none;">
            <h5 class="mb-0" style="color: #ffffff; font-weight: 600;">
                <i class="fas fa-comments me-2"></i> Daftar Testimoni
            </h5>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead style="background-color: #eef3fb;">
                    <tr>
                        <th class="text-center py-3" style="color:#2c5aa0; font-weight:600;">Nama</th>
                        <th class="text-center py-3" style="color:#2c5aa0; font-weight:600;">Testimoni</th>
                        <th class="text-center py-3" style="color:#2c5aa0; font-weight:600;">Status</th>
                        <th class="text-center py-3" style="color:#2c5aa0; font-weight:600;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($items as $it)
                        <tr>
                            <!-- Nama -->
                            <td class="text-center py-3">
                                <span style="font-weight:600; color:#2c5aa0;">{{ $it->name }}</span>
                            </td>

                            <!-- Testimoni -->
<td class="text-center py-3">
    <div style="
        max-width: 350px;
        max-height: 80px;
        overflow-y: auto;
        overflow-x: hidden;
        white-space: normal;
        word-wrap: break-word;
        margin: 0 auto;
        color: #2c5aa0;
        font-size: 0.95rem;
        text-align: left;
        padding-right: 6px;">
        {{ $it->content }}
    </div>
</td>


                            <!-- Status -->
                            <td class="text-center py-3">
                                @if($it->status == 'approved')
                                    <span class="badge bg-success px-3 py-2">Approved</span>
                                @elseif($it->status == 'rejected')
                                    <span class="badge bg-danger px-3 py-2">Rejected</span>
                                @else
                                    <span class="badge bg-warning px-3 py-2">Pending</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="text-center py-3">
                                <div class="d-flex justify-content-center gap-2 flex-wrap">

                                    @if($it->status !== 'approved')
                                        <form action="{{ route('admin.testimonial.approve', $it->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if($it->status !== 'rejected')
                                        <form action="{{ route('admin.testimonial.reject', $it->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-warning">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.testimonial.destroy', $it->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x mb-2" style="color:#c7d1e1;"></i>
                                <p class="text-muted">Belum ada testimoni</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f3f7ff !important;
    }

    .btn-sm {
        padding: 6px 10px !important;
        border-radius: 6px !important;
    }

    .btn-sm i {
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .btn-sm {
            padding: 5px 8px !important;
        }
    }
</style>

@endsection
