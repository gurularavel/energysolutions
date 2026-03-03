<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::orderBy('sort_order')->get();
        $images = GalleryImage::active()
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        return view('pages.gallery', compact('categories', 'images'));
    }
}
