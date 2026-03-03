<?php

namespace Database\Seeders;

use App\Models\GalleryFeature;
use Illuminate\Database\Seeder;

class GalleryFeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            [
                'title'      => 'Foto Qalereya',
                'description'=> null,
                'link'       => '/gallery',
                'sort_order' => 1,
                'is_active'  => true,
            ],
            [
                'title'      => 'Video qalereya',
                'description'=> null,
                'link'       => '#',
                'sort_order' => 2,
                'is_active'  => true,
            ],
        ];

        foreach ($features as $data) {
            GalleryFeature::create($data);
        }
    }
}
