<?php

namespace App\Http\Controllers;

use App\Models\Certificate;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::active()->get();

        return view('pages.certificates', compact('certificates'));
    }
}
