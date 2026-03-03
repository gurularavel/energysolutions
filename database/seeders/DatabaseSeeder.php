<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            SliderSeeder::class,
            HomepageSectionSeeder::class,
            ServiceSeeder::class,
            GalleryCategorySeeder::class,
            GalleryImageSeeder::class,
            CertificateSeeder::class,
            StatSeeder::class,
            TestimonialSeeder::class,
            PartnerSeeder::class,
            BlogPostSeeder::class,
            GalleryFeatureSeeder::class,
        ]);
    }
}
