<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CvController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cv' => 'required|mimes:pdf|max:1000'
        ]);

        Storage::delete('document/mycv.pdf');
        $request->file('cv')->storeAs('document', 'mycv.pdf');

        return response()->json(['message' => 'cv upload successfully']);
    }

    public function download()
    {
        return Storage::download('document/mycv.pdf');
    }
}
