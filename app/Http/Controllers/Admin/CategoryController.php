<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        $slug = Str::slug($request->name);
        Category::create(['name'=>$request->name,'slug'=>$slug,'description'=>$request->description]);
        return redirect()->route('admin.category.index')->with('success','Category added');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate(['name'=>'required']);
        $category->update(['name'=>$request->name,'slug'=>Str::slug($request->name),'description'=>$request->description]);
        return redirect()->route('admin.category.index')->with('success','Category updated');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('success','Category deleted');
    }
}
