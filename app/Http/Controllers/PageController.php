<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Staff;
use App\Models\Carousel;
use App\Models\Category;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $page = null;
        $carousels = [];
        $menu_categories = [];

        // 🔹 tambahan default supaya tidak error kalau terjadi exception
        $testimonials = []; // <-- tambahan

        try {
            $page = \App\Models\Page::where('slug', 'beranda')->first();
            $carousels = Carousel::orderBy('order')->where('is_active', true)->get();

            // load up to 2 categories, each with up to 3 menus (total up to 6 items)
            $menu_categories = Category::with(['menus' => function($q){
                $q->orderBy('created_at','desc');
            }])->whereHas('menus')->orderBy('id')->take(2)->get();

            // 🔹 AMBIL TESTIMONI APPROVED — SAMA SEPERTI HALAMAN /testimonial
            $testimonials = Testimonial::where('status', 'approved')
                ->orderBy('created_at', 'desc')
                ->get(); // <-- tambahan

        } catch (\Throwable $e) { }

        // 🔹 kirim $testimonials ke index
        return view('index', compact('page', 'carousels', 'menu_categories', 'testimonials')); // <-- tambahan
    }


    public function welcome()
    {
        $page = null;
        try {
            $page = \App\Models\Page::whereIn('slug', ['welcome', 'beranda'])->first();
        } catch (\Throwable $e) {
        }
        return view('welcome', compact('page'));
    }

    public function about()
    {
        $page = null;
        $staff = [];
        try {
            $page = \App\Models\Page::whereIn('slug', ['about', 'deskripsi-singkat'])->first();
            $staff = Staff::all();
        } catch (\Throwable $e) {
        }
        return view('about', compact('page', 'staff'));
    }

    public function contact()
    {
        $page = null;
        try {
            $page = \App\Models\Page::whereIn('slug', ['contact', 'kontak'])->first();
        } catch (\Throwable $e) {
        }
        return view('contact', compact('page'));
    }

    public function menu()
    {
        // load menus from DB if available, otherwise keep static
        $menus = [];
        try {
            $menus = \App\Models\Menu::orderBy('created_at', 'desc')->get();
        } catch (\Throwable $e) { }

        $categories = [];
        try {
            $categories = \App\Models\Category::all();
        } catch (\Throwable $e) { }

        return view('menu', compact('menus', 'categories'));
    }

    public function service()
    {
        $page = null;
        $services = [];
        try {
            $page = \App\Models\Page::whereIn('slug', ['service', 'servis'])->first();
            $services = \App\Models\Service::where('is_active', true)->orderBy('order')->get();
        } catch (\Throwable $e) { }
        return view('service', compact('page', 'services'));
    }

    public function reservation()
    {
        $page = null;
        try {
            $page = \App\Models\Page::whereIn('slug', ['reservation', 'reservasi'])->first();
        } catch (\Throwable $e) { }
        return view('reservation', compact('page'));
    }

    public function testimonial()
    {
        $testimonials = Testimonial::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('testimonial', compact('testimonials'));
    }

    public function storeTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rating' => 'required',
            'testimonial' => 'required',
        ]);

        Testimonial::create([
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'content' => $request->testimonial,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil dikirim!');
    }
}
