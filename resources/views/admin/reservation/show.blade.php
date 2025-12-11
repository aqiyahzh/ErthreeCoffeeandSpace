@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4" style="background-color: #f8f9fa;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="mb-2" style="color: #2c5aa0; font-weight: 600;">Detail Reservasi</h2>
            <p class="text-muted mb-0">Informasi lengkap reservasi</p>
        </div>
    </div>

    <div class="row">
        <!-- Reservation Details -->
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header" style="background-color: #2c5aa0; color: #fff; border: none; padding: 1.25rem;">
                    <h5 class="mb-0" style="font-weight: 600;">
                        <i class="fas fa-info-circle me-2"></i>Informasi Reservasi
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="text-muted small">Nama Lengkap</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                {{ $reservation->name }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small">Email</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                {{ $reservation->email }}
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="text-muted small">Nomor Telepon</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                {{ $reservation->phone ?? '-' }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small">Tipe Ruangan</label>
                            <p class="h5">
                                @if($reservation->room_type == 'vip')
                                    <span class="badge" style="background-color: #ffc107; color:#000; padding: 0.6rem 0.9rem; border-radius:6px;">
                                        <i class="fas fa-crown me-1"></i>{{ ucfirst($reservation->room_type) }}
                                    </span>

                                @elseif($reservation->room_type == 'workspace')
                                    <span class="badge" style="background-color: #17a2b8; color:white; padding: 0.6rem 0.9rem; border-radius:6px;">
                                        <i class="fas fa-laptop me-1"></i>{{ ucfirst($reservation->room_type) }}
                                    </span>

                                @else
                                    <span class="badge" style="background-color: #e83e8c; color:white; padding: 0.6rem 0.9rem; border-radius:6px;">
                                        <i class="fas fa-microphone-alt me-1"></i>{{ ucfirst($reservation->room_type) }}
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="text-muted small">Tanggal</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                <i class="fas fa-calendar-day me-1"></i>
                                {{ $reservation->date->format('d F Y') }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small">Jam</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                <i class="fas fa-clock me-1"></i>
                                {{ is_string($reservation->time) 
                                    ? \Carbon\Carbon::createFromFormat('H:i:s', $reservation->time)->format('H:i')
                                    : $reservation->time->format('H:i') 
                                }} WITA
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="text-muted small">Jumlah Orang / Keterangan</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                {{ $reservation->person_detail ?? '-' }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="text-muted small">Diajukan Pada</label>
                            <p class="h5" style="color: #2c5aa0; font-weight: 600;">
                                {{ $reservation->created_at->format('d F Y H:i') }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small">Status</label>
                            <p class="h5">
                                @if ($reservation->status === 'pending')
                                    <span class="badge" style="background-color:#ffc107; color:#000; padding:0.6rem 0.9rem;">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>

                                @elseif ($reservation->status === 'confirmed')
                                    <span class="badge" style="background-color:#28a745; color:white; padding:0.6rem 0.9rem;">
                                        <i class="fas fa-check me-1"></i>Confirmed
                                    </span>

                                @else
                                    <span class="badge" style="background-color:#dc3545; color:white; padding:0.6rem 0.9rem;">
                                        <i class="fas fa-times me-1"></i>Cancelled
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="col-lg-4">
            <div class="card shadow-sm" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header" style="background-color: #2c5aa0; color:#fff; padding:1.25rem;">
                    <h5 class="mb-0" style="font-weight: 600;">
                        <i class="fas fa-tasks me-2"></i>Aksi
                    </h5>
                </div>

                <div class="card-body">
                    @if ($reservation->status === 'pending')
                        <form action="{{ route('admin.reservation.approve', $reservation->id) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn w-100" 
                                style="background-color:#28a745; color:white; padding:0.75rem 1rem; font-weight:600;"
                                onclick="return confirm('Konfirmasi reservasi ini?')">
                                <i class="fas fa-check-circle me-2"></i>Approve
                            </button>
                        </form>

                        <form action="{{ route('admin.reservation.cancel', $reservation->id) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn w-100" 
                                style="background-color:#ffc107; color:black; padding:0.75rem 1rem; font-weight:600;"
                                onclick="return confirm('Batalkan reservasi ini?')">
                                <i class="fas fa-times-circle me-2"></i>Reject
                            </button>
                        </form>

                    @elseif ($reservation->status === 'confirmed')
                        <div class="alert alert-success mb-3">
                            <i class="fas fa-check-circle me-2"></i><strong>Reservasi telah dikonfirmasi</strong>
                        </div>

                        <form action="{{ route('admin.reservation.cancel', $reservation->id) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn w-100" 
                                style="background-color:#ffc107; color:black; padding:0.75rem 1rem; font-weight:600;"
                                onclick="return confirm('Batalkan reservasi ini?')">
                                <i class="fas fa-times-circle me-2"></i>Cancel Reservation
                            </button>
                        </form>

                    @else
                        <div class="alert alert-danger mb-3">
                            <i class="fas fa-times-circle me-2"></i><strong>Reservasi telah dibatalkan</strong>
                        </div>
                    @endif

                    <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-100" 
                            style="background-color:#dc3545; color:white; padding:0.75rem 1rem; font-weight:600;"
                            onclick="return confirm('Hapus reservasi ini? Tindakan ini tidak dapat dibatalkan.')">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </form>

                    <a href="{{ route('admin.reservation.index') }}" 
                       class="btn w-100"
                       style="background-color:#6c757d; color:white; padding:0.75rem 1rem; font-weight:600;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
