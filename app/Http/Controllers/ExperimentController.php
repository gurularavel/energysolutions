<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ExperimentController extends Controller
{
    public function show()
    {
        $service = Service::where('type', 'experiment')
            ->where('is_active', true)
            ->firstOrFail();

        $service->load(['accordionSections', 'checklistItems', 'supportingImages']);

        return view('pages.service-detail', compact('service'));
    }
}
