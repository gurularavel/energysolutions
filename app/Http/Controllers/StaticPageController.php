<?php

namespace App\Http\Controllers;

use App\Models\HomepageSection;

class StaticPageController extends Controller
{
    public function about()
    {
        $section = HomepageSection::getSection('about');
        return view('pages.static.about', compact('section'));
    }

    public function labStudies()
    {
        $section = HomepageSection::getSection('slogan2');
        return view('pages.static.lab-studies', compact('section'));
    }

    public function futureServices()
    {
        $section = HomepageSection::getSection('future_services');
        return view('pages.static.future-services', compact('section'));
    }
}
