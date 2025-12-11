<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // index: listing untuk admin
    public function index(Request $request)
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.reservation.index', compact('reservations'));
    }

    // show: detail reservasi
    public function show(Reservation $reservation)
    {
        return view('admin.reservation.show', compact('reservation'));
    }

    // approve: tandai confirmed
    public function approve(Reservation $reservation)
    {
        $reservation->update(['status' => 'confirmed']);
        return redirect()->route('admin.reservation.show', $reservation->id)->with('success', 'Reservasi dikonfirmasi.');
    }

    // cancel: tandai cancelled
    public function cancel(Reservation $reservation)
    {
        $reservation->update(['status' => 'cancelled']);
        return redirect()->route('admin.reservation.show', $reservation->id)->with('success', 'Reservasi dibatalkan.');
    }

    // destroy: hapus reservasi
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservation.index')->with('success', 'Reservasi dihapus.');
    }

    // existing page edit/update (keperluan halaman Page model)
    // public function edit()
    // {
    //     $page = Page::firstOrCreate(['slug' => 'reservation'], ['title' => 'Reservasi', 'content' => '']);
    //     return view('admin.reservation.edit', compact('page'));
    // }

    // public function update(Request $request)
    // {
    //     $page = Page::firstOrCreate(['slug' => 'reservation']);
    //     $request->validate(['title' => 'nullable|string', 'content' => 'nullable|string']);
        // $page->update($request->only('title', 'content'));
        // return redirect()->route('admin.reservation.edit')->with('success', 'Reservation page updated');
    // }
}
