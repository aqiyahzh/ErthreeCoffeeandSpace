<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialUserController extends Controller
{
    /**
     * Simpan testimonial yang dikirim user (dari form di halaman testimonial.blade.php).
     * Mapping: form field 'testimonial' -> column 'content'
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'rating'      => 'required|integer|min:1|max:5',
            'testimonial' => 'required|string',
        ]);

        Testimonial::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'rating'      => $request->rating,
            'content'     => $request->testimonial, // mapping ke content
            'status'      => 'pending', // default: harus di-approve admin dulu
            // 'photo' dan 'published_at' dibiarkan kosong untuk submission user
        ]);

        return redirect()->back()->with('success', 'Terima kasih. Testimoni Anda telah dikirim dan menunggu persetujuan.');
    }
}
