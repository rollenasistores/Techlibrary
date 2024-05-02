<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    
    public function store(Request $request) {

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required',
            'details' => 'required',
        ]);

        Contact::create($request->all());

        session()->flash('message', 'Success!');

        return redirect()->route('aboutus')->with('message', session('message'));


    }
}
