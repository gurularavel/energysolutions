<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 4; $i++) {
            Partner::create([
                'name'       => "Partner {$i}",
                'link'       => '#',
                'sort_order' => $i,
                'is_active'  => true,
            ]);
        }
    }
}
