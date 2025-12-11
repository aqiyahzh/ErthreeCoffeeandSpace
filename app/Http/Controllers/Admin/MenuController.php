<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('created_at','desc')->paginate(8);
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'image|mimes:jpg,png,jpeg|max:4096'
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/menu'), $imageName);
        }

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.menu.index')->with('success','Menu added');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.menu.edit', compact('menu','categories'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'image|mimes:jpg,png,jpeg|max:4096'
        ]);

        $imageName = $menu->image;
        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads/menu'), $imageName);
        }

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.menu.index')->with('success','Menu updated');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->image && file_exists(public_path('uploads/menu/'.$menu->image))) {
            @unlink(public_path('uploads/menu/'.$menu->image));
        }
        $menu->delete();
        return redirect()->route('admin.menu.index')->with('success','Menu deleted');
    }
}
