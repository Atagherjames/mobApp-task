<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function addContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:contacts',
            'email' => 'nullable|email',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id' => auth()->id()
        ]);

        return response()->json(['message' => 'Contact added successfully', 'contact' => $contact]);
    }

    public function listContacts()
    {
        return response()->json(auth()->user()->contacts);
    }

}