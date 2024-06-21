<?php
// app/Http/Controllers/ImageGalleryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageGalleryController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('my-mind', compact('images'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');
        $path = $image->store('images', 'public');

        Image::create(['path' => $path]);

        return redirect()->route('my-mind')->with('success', 'Image Uploaded Successfully');
    }
}
