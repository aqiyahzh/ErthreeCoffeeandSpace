<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::orderBy('order')->get();
        return view('admin.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/carousel'), $imageName);
        }

        Carousel::create([
            'title' => $request->title,
            'image' => $imageName,
            'order' => Carousel::max('order') + 1 ?? 0,
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil ditambahkan');
    }

    public function edit(Carousel $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, Carousel $carousel)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->image = $imageName;
        }

        $carousel->title = $request->title;
        $carousel->save();

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil diupdate');
    }

    public function destroy(Carousel $carousel)
    {
        $carousel->delete();
        return redirect()->route('admin.carousel.index')->with('success', 'Carousel berhasil dihapus');
    }
}
