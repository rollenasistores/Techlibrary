<?php

namespace App\Http\Controllers;

use App\Models\LibraryStatus;
use Illuminate\Http\Request;

class LibraryStatusController extends Controller
{
    public function show()
    {
        return LibraryStatus::latest()->first();
    }

    public function update(Request $request)
    {
        $libraryStatus = LibraryStatus::latest()->first();
        $libraryStatus->update($request->all());
        return $libraryStatus;
    }
}
