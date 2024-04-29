<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class photoController extends Controller
{
    public function show($filename)
    {
        $filePath = $filename;

        if (Storage::exists($filePath)) {
            $file = Storage::get($filePath);
            $mimeType = Storage::mimeType($filePath);

            return response($file, 200)->header('Content-Type', $mimeType);
        }else {
            dd('gg');
        }

    }
}
