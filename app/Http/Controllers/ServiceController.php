<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function show(string $locale, Service $service)
    {
        $service->load(['accordionSections', 'checklistItems', 'checklistGroups', 'supportingImages']);

        return view('pages.service-detail', compact('service'));
    }
}
