<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        $service->load(['accordionSections', 'checklistItems', 'supportingImages']);

        return view('pages.service-detail', compact('service'));
    }
}
