<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $categoryMap = [
            'lab'  => GalleryCategory::where('filter_class', 'lab')->first()?->id,
            'offi' => GalleryCategory::where('filter_class', 'offi')->first()?->id,
            'out'  => GalleryCategory::where('filter_class', 'out')->first()?->id,
            'eks'  => GalleryCategory::where('filter_class', 'eks')->first()?->id,
        ];

        // lab: 1-1 to 1-31 (1-18 missing)
        $labImages = array_merge(range(1, 17), range(19, 31));
        foreach ($labImages as $i => $n) {
            GalleryImage::create([
                'gallery_category_id' => $categoryMap['lab'],
                'alt_text'            => "1-{$n}.jpg",
                'height_class'        => ($n === 2) ? 'height-lg' : 'height-sm',
                'sort_order'          => $i + 1,
                'is_active'           => true,
            ]);
        }

        // offi: 2-1 to 2-6
        foreach (range(1, 6) as $i => $n) {
            GalleryImage::create([
                'gallery_category_id' => $categoryMap['offi'],
                'alt_text'            => "2-{$n}.jpg",
                'height_class'        => ($n === 3) ? 'height-lg' : 'height-sm',
                'sort_order'          => $i + 1,
                'is_active'           => true,
            ]);
        }

        // out: 3-1 to 3-29
        foreach (range(1, 29) as $i => $n) {
            GalleryImage::create([
                'gallery_category_id' => $categoryMap['out'],
                'alt_text'            => "3-{$n}.jpg",
                'height_class'        => ($n === 1) ? 'height-lg' : 'height-sm',
                'sort_order'          => $i + 1,
                'is_active'           => true,
            ]);
        }

        // eks: 4-1 to 4-8
        foreach (range(1, 8) as $i => $n) {
            GalleryImage::create([
                'gallery_category_id' => $categoryMap['eks'],
                'alt_text'            => "4-{$n}.jpg",
                'height_class'        => ($n === 2) ? 'height-lg' : 'height-sm',
                'sort_order'          => $i + 1,
                'is_active'           => true,
            ]);
        }
    }
}
