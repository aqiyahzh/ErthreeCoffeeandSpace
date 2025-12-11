<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('admin.page.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.page.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate(['title' => 'nullable', 'content' => 'nullable']);
        $page->update($request->only('title', 'content'));
        return redirect()->route('admin.page.index')->with('success', 'Page updated');
    }

    public function testimonial()
    {
        $testimonials = \App\Models\Testimonial::where('status', 'approved')->orderBy('created_at', 'desc')->get();
        return view('testimonial', compact('testimonials'));
    }
}
