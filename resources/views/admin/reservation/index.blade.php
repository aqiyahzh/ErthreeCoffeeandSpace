@extends('layouts.admin')

@section('content')

<style>
    /* Wrapper konten */
    .page-wrapper {
        background: #fff;
        padding: 2rem 2.2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-top: 1.2rem;
    }

    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.3rem;
    }

    .page-subtitle {
        color: #6c757d;
        margin-bottom: 1.2rem;
    }

    /* Card header */
    .table-header {
        background: #2c5aa0;
        color: #fff;
        font-size: 1.1rem;
        padding: 0.9rem 1.2rem;
        border-radius: 6px 6px 0 0;
        font-weight: 600;
    }

    /* Tabel */
    table.table {
        background: #fff;
        border-radius: 0 0 10px 10px;
        overflow: hidden;
        margin: 0;
    }

    table.table th {
        background: #eef3fb;
        padding: 0.9rem;
        font-weight: 600;
        text-align: center;
        border-bottom: 1px solid #dce3f0;
    }

    table.table td {
        padding: 0.85rem;
        text-align: center;
        vertical-align: middle;
    }

    /* Badge */
    .badge-custom {
        background: #2c5aa0;
        color: #fff;
        padding: 0.35rem 0.65rem;
        border-radius: 6px;
        font-size: 0.8rem;
    }

    /* Tombol Icon */
    .btn-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
        cursor: pointer;
        color: #fff;
    }

    .btn-icon i { font-size: 0.85rem; }

    .btn-icon.detail  { background: #2c5aa0; }
    .btn-icon.approve { background: #28a745; }
    .btn-icon.cancel  { background: #ffc107; color:#000 !important; }
    .btn-icon.delete  { background: #dc3545; }

    .btn-icon:hover {
        opacity: 0.85;
        transform: translateY(-1px);
    }

    /* Kolom aksi */
    table.table th:last-child,
    table.table td:last-child {
        width: 120px;
    }
</style>


<div class="page-wrapper">

    <h2 class="page-title">Kelola Reservasi</h2>
    <p class="page-subtitle">Daftar reservasi yang masuk pada sistem.</p>

    <!-- HEADER TABEL -->
    <div class="table-header">
        Daftar Reservasi
    </div>

    <!-- TABEL -->
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Tipe Ruangan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->name }}</td>

                <td>{{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}</td>

                <td>{{ $reservation->time }}</td>

<td>
    <span class="badge badge-custom" style="font-size: 0.95rem; padding: 6px 12px;">
        {{ $reservation->room_type }}
    </span>
</td>


                <td>
                    @if($reservation->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($reservation->status == 'confirmed')
                        <span class="badge bg-success">Confirmed</span>
                    @else
                        <span class="badge bg-danger">Canceled</span>
                    @endif
                </td>


                <!-- AKSI -->
                <td>
                    <div style="display:flex; gap:0.35rem; justify-content:center;">

                        <!-- Detail -->
                        <a href="{{ route('admin.reservation.show', $reservation->id) }}" 
                           class="btn-icon detail" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>

                        @if ($reservation->status === 'pending')
                            
                            <!-- Approve -->
                            <form action="{{ route('admin.reservation.approve', $reservation->id) }}" 
                                  method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-icon approve" title="Approve"
                                    onclick="return confirm('Konfirmasi reservasi ini?')">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>

                            <!-- Cancel -->
                            <form action="{{ route('admin.reservation.cancel', $reservation->id) }}" 
                                  method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-icon cancel" title="Cancel"
                                    onclick="return confirm('Batalkan reservasi ini?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>

                        @elseif ($reservation->status === 'confirmed')

                            <!-- Cancel only -->
                            <form action="{{ route('admin.reservation.cancel', $reservation->id) }}" 
                                  method="POST" style="margin:0;">
                                @csrf
                                <button type="submit" class="btn-icon cancel" title="Cancel"
                                    onclick="return confirm('Batalkan reservasi ini?')">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>

                        @endif

                        <!-- Delete -->
                        <form action="{{ route('admin.reservation.destroy', $reservation->id) }}" 
                              method="POST" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon delete" title="Hapus"
                                onclick="return confirm('Hapus reservasi ini secara permanen?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection
