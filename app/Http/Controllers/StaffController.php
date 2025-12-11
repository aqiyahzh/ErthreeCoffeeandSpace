<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'photo' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $photoName = time().'_'.$request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/staff'), $photoName);
        }

        Staff::create([
            'name' => $request->name,
            'position' => $request->position,
            'photo' => $photoName
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff added successfully!');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $photoName = $staff->photo;

        if ($request->hasFile('photo')) {
            $photoName = time().'_'.$request->photo->getClientOriginalName();
            $request->photo->move(public_path('uploads/staff'), $photoName);
        }

        $staff->update([
            'name' => $request->name,
            'position' => $request->position,
            'photo' => $photoName
        ]);

        return redirect()->route('admin.staff.index')->with('success', 'Staff updated!');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);

        if ($staff->photo && file_exists(public_path('uploads/staff/'.$staff->photo))) {
            unlink(public_path('uploads/staff/'.$staff->photo));
        }

        $staff->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff removed!');
    }
}
