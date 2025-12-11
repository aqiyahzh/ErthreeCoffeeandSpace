<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function edit()
{
    $contact = Contact::first() ?? new Contact();
    return view('admin.contact.edit', compact('contact'));
}

public function update(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'weekday_hours' => 'nullable|string',
        'weekend_hours' => 'nullable|string',
        'instagram' => 'nullable|string',
        'whatsapp' => 'nullable|string',
        'email' => 'nullable|string',
        'map_url' => 'nullable|string',
    ]);

    Contact::updateOrCreate(['id' => 1], $data);

    return back()->with('success', 'Contact page updated.');
}

public function show()
{
    $contact = Contact::first();
    return view('contact', compact('contact'));
}


    
}
