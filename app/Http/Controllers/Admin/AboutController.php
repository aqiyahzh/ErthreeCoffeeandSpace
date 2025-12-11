<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $page = Page::firstOrCreate(['slug' => 'about'], ['title' => 'Tentang Kami', 'content' => '']);
        return view('admin.about.edit', compact('page'));
    }

    public function update(Request $request)
    {
        $page = Page::firstOrCreate(['slug' => 'about']);
        $request->validate(['title' => 'nullable|string', 'content' => 'nullable|string']);
        $page->update($request->only('title', 'content'));
        return redirect()->route('admin.about.edit')->with('success', 'About page updated');
    }
}
