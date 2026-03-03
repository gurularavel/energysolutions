<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Laboratoriya', 'filter_class' => 'lab',  'sort_order' => 1],
            ['name' => 'Ofis',         'filter_class' => 'offi', 'sort_order' => 2],
            ['name' => 'Çöl işləri',   'filter_class' => 'out',  'sort_order' => 3],
            ['name' => 'Ekstrasiya',   'filter_class' => 'eks',  'sort_order' => 4],
        ];

        foreach ($categories as $data) {
            GalleryCategory::create($data);
        }
    }
}
