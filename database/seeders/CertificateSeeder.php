<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Certificate::create([
                'title'      => "Sertifikat {$i}",
                'sort_order' => $i,
                'is_active'  => true,
            ]);
        }
    }
}
