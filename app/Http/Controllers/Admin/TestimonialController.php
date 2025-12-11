<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    // Tampil semua testimoni di admin (pending, approved, rejected)
    public function index()
    {
        // gunakan variable $items supaya sesuai view admin index lama (kalau viewmu pakai $items)
        $items = Testimonial::orderBy('created_at', 'desc')->get();
        return view('admin.testimonial.index', compact('items'));
    }

    // Halaman create (admin)
    public function create()
    {
        return view('admin.testimonial.create');
    }

    // Simpan testimoni via admin (admin menambah manual)
    public function store(Request $request)
    {
        $request->validate(['content' => 'required']);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/testimonial'), $photoName);
        }

        Testimonial::create([
            'name' => $request->name,
            'content' => $request->content,
            'photo' => $photoName,
            'published_at' => $request->published_at,
            'status' => $request->status ?? 'approved', // admin-created bisa langsung approved
        ]);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial added');
    }

    // Edit admin
    public function edit($id)
    {
        $item = Testimonial::findOrFail($id);
        return view('admin.testimonial.edit', compact('item'));
    }

    // Update admin
    public function update(Request $request, $id)
    {
        $item = Testimonial::findOrFail($id);
        $request->validate(['content' => 'required']);

        $photoName = $item->photo;
        if ($request->hasFile('photo')) {
            $photoName = time() . '_' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/testimonial'), $photoName);
        }

        $item->update([
            'name' => $request->name,
            'content' => $request->content,
            'photo' => $photoName,
            'published_at' => $request->published_at,
            'status' => $request->status ?? $item->status,
        ]);

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated');
    }

    // Hapus testimoni
    public function destroy($id)
    {
        $item = Testimonial::findOrFail($id);
        if ($item->photo && file_exists(public_path('uploads/testimonial/' . $item->photo))) {
            @unlink(public_path('uploads/testimonial/' . $item->photo));
        }
        $item->delete();
        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial deleted');
    }

    // Approve testimoni (admin action)
    public function approve($id)
    {
        $item = Testimonial::findOrFail($id);
        $item->status = 'approved';
        $item->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil di-approve');
    }

    // Reject testimoni (admin action) — tetap disimpan tapi status jadi rejected
    public function reject($id)
    {
        $item = Testimonial::findOrFail($id);
        $item->status = 'rejected';
        $item->save();

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimoni berhasil ditolak');
    }
}
