<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * TAMPILKAN HALAMAN RESERVASI USER
     */
    public function index()
    {
        $today = now()->toDateString();

        // Cek apakah hari ini ruangan sudah dibooking (pending/confirmed)
        $booked = [
            'vip' => Reservation::where('room_type', 'vip')
                        ->whereDate('date', $today)
                        ->whereIn('status', ['pending','confirmed'])
                        ->exists(),

            'workspace' => Reservation::where('room_type', 'workspace')
                        ->whereDate('date', $today)
                        ->whereIn('status', ['pending','confirmed'])
                        ->exists(),

            'karaoke' => Reservation::where('room_type', 'karaoke')
                        ->whereDate('date', $today)
                        ->whereIn('status', ['pending','confirmed'])
                        ->exists(),
        ];

        // Jika kamu ingin menampilkan halaman dengan $page (opsional)
        $page = \App\Models\Page::whereIn('slug', ['reservation','reservasi'])->first();

        return view('reservation', compact('booked','page'));
    }

    /**
     * SIMPAN RESERVASI USER
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'required|string|max:50',
            'room_type'     => 'required|in:vip,workspace,karaoke',
            'date'          => 'required|date',
            'time'          => 'required',        // format: H:i
            'duration'      => 'required|integer|min:15|max:1440',
            'person_detail' => 'nullable|string|max:500',
        ]);

        // Buat waktu mulai & selesai
        $start = Carbon::createFromFormat('Y-m-d H:i', $data['date'].' '.$data['time']);
        $end = (clone $start)->addMinutes($data['duration']);

        // Cek bentrok dengan reservation lain
        $conflict = Reservation::where('room_type', $data['room_type'])
            ->whereIn('status', ['pending','confirmed'])
            ->whereDate('date', $data['date'])
            ->where(function($q) use ($start, $end) {
                $q->where(function($qq) use ($start, $end) {
                    $qq->where('time', '<', $end->format('H:i:s'))
                       ->where('end_time', '>', $start->format('H:i:s'));
                });
            })
            ->exists();

        // Jika bentrok -> rejected
        if ($conflict) {
            $data['status'] = 'rejected';

            Reservation::create(array_merge($data, [
                'end_time'   => $end->format('H:i:s'),
                'wa_message' => null,
                'wa_sent'    => false,
            ]));

            return redirect()->route('reservation')
                ->with('error', 'Maaf, waktu yang Anda pilih bentrok dengan reservasi lain. Mohon pilih waktu lain.');
        }

        // Jika tidak bentrok -> pending
        $data['status'] = 'pending';
        $reservation = Reservation::create(array_merge($data, [
            'end_time' => $end->format('H:i:s'),
        ]));

        // Buat pesan WA otomatis
        $waMessage =
            "Halo, saya ingin konfirmasi reservasi:\n".
            "Nama: {$reservation->name}\n".
            "Ruangan: ".strtoupper($reservation->room_type)."\n".
            "Tanggal: ".$reservation->date->format('Y-m-d')."\n".
            "Waktu: {$reservation->time}\n".
            "Durasi: {$reservation->duration} menit\n".
            "Detail: {$reservation->person_detail}\n";

        $reservation->update([
            'wa_message' => $waMessage,
            'wa_sent'    => false,
        ]);

        // Simpan session untuk tombol WA
        session()->flash('reservation_wa', [
            'name'          => $reservation->name,
            'phone'         => $reservation->phone,
            'room_type'     => $reservation->room_type,
            'date'          => $reservation->date->format('Y-m-d'),
            'time'          => $reservation->time,
            'duration'      => $reservation->duration,
            'person_detail' => $reservation->person_detail,
        ]);

        return redirect()->route('reservation')
            ->with('success', 'Reservasi berhasil dibuat. Silakan konfirmasi lewat WhatsApp.');
    }
}
