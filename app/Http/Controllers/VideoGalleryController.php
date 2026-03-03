<?php

namespace App\Http\Controllers;

use App\Models\VideoGalleryItem;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = VideoGalleryItem::active()->get();

        return view('pages.video-gallery', compact('videos'));
    }
}
