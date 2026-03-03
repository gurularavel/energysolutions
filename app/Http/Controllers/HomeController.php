<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\GalleryFeature;
use App\Models\HomepageSection;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\VideoGalleryItem;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'sliders'         => Slider::active()->get(),
            'services'        => Service::active()->services()->get(),
            'about'           => HomepageSection::getSection('about'),
            'slogan1'         => HomepageSection::getSection('slogan1'),
            'slogan2'         => HomepageSection::getSection('slogan2'),
            'certText'        => HomepageSection::getSection('cert_text'),
            'futureServices'  => HomepageSection::getSection('future_services'),
            'galleryFeatures' => GalleryFeature::active()->get(),
            'stats'           => Stat::orderBy('sort_order')->get(),
            'testimonials'    => Testimonial::active()->get(),
            'partners'        => Partner::active()->get(),
            'blogPosts'       => BlogPost::active()->get(),
            'latestVideos'    => VideoGalleryItem::active()->limit(3)->get(),
        ]);
    }
}
