<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceChecklistItem;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'              => 'Kern və şlam nümunələri üzərində tədqiqatlar',
                'slug'               => 'core-sample-research',
                'type'               => 'service',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 1,
                'is_active'          => true,
                'checklist'          => [
                    ['content' => 'Tədqiqatın standartına uyğun nümunələrin götürülməsi, kəsilməsi və hazırlanması', 'section_group' => 'group1'],
                    ['content' => 'Hazırlanmış nümunələrin kənar qarışıqlardan təmizlənməsi qurudulması, sokslet aparatı ilə', 'section_group' => 'group1'],
                    ['content' => 'Kapilyar təzyiqin ölçülməsi 0-2000 PSİ təzyiqdə-minimum məsamə ölçüsü-0.05micron', 'section_group' => 'group1'],
                    ['content' => 'Kapilyar təzyiqin ölçülməsi 0-6000 PSİ təzyiqdə-minimum məsamə ölçüsü-0.003micron', 'section_group' => 'group1'],
                    ['content' => 'Elektrik müqavimətinin ölçülməsi', 'section_group' => 'group1'],
                    ['content' => 'Yekun hesab hazırlanması və prosesin icrasına nəzarət', 'section_group' => 'group1'],
                    ['content' => 'Kollektor xüsusiyyətlərinin təyini (mütləq keçiricilik, məsaməlik, dənələrin sıxlığı)', 'section_group' => 'group2'],
                    ['content' => 'Nümunənin tərkibində kalsium karbonatın təyini', 'section_group' => 'group2'],
                    ['content' => 'Nümunənin tərkibində dolomitin təyini', 'section_group' => 'group2'],
                    ['content' => 'Ümumi karbonatlığın təyini', 'section_group' => 'group2'],
                    ['content' => 'Tədqiqatın standartına uyğun nümunələrin götürülməsi, təmizlənməsi, emalı', 'section_group' => 'group2'],
                    ['content' => 'Lazer üsulu ilə qranulometrik tərkibin təyini', 'section_group' => 'group2'],
                    ['content' => 'Nümunələrin karbohidrogen qarışıqlardan təmizlənməsi, standarta uyğun emalı, qurudulması', 'section_group' => 'group2'],
                    ['content' => 'Quru və nəm ələmə üsulu ilə qranulometrik tərkibin təyini (ASTM, BS, QOST standartına uyğun)', 'section_group' => 'group2'],
                    ['content' => 'Nümunələrin makroskopik və mikroskopik təhlili, mikroskopik təsvirlərin alınması', 'section_group' => 'group2'],
                    ['content' => 'Ümumi litoloji və sedimentoloji kəsilişlərin tərtibi', 'section_group' => 'group2'],
                ],
            ],
            [
                'title'              => 'Mexaniki təsir üsullarının tədbiqi',
                'slug'               => 'mechanical-impact',
                'type'               => 'service',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 2,
                'is_active'          => true,
                'checklist'          => [],
            ],
            [
                'title'              => 'Qeyri ənənəvi yanar faydalı qazıntılar',
                'slug'               => 'unconventional-minerals',
                'type'               => 'service',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 3,
                'is_active'          => true,
                'checklist'          => [],
            ],
            [
                'title'              => 'Neft, Su və Qazın ümumi analizi',
                'slug'               => 'oil-water-gas-analysis',
                'type'               => 'service',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 4,
                'is_active'          => true,
                'checklist'          => [],
            ],
            [
                'title'              => 'Geofiziki və Geokimyəvi tədqiqatlar',
                'slug'               => 'geophysical-geochemical-research',
                'type'               => 'service',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 5,
                'is_active'          => true,
                'checklist'          => [],
            ],
            [
                'title'              => 'Mühəndisi geoloji tədqiqatlar',
                'slug'               => 'engineering-geological-research',
                'type'               => 'service',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 6,
                'is_active'          => true,
                'checklist'          => [],
            ],
            [
                'title'              => 'Səriştəlilik sınaqları',
                'slug'               => 'proficiency-tests',
                'type'               => 'experiment',
                'card_icon_class'    => 'icon-check',
                'featured_icon_class'=> 'icon-creative',
                'sort_order'         => 7,
                'is_active'          => true,
                'checklist'          => [],
            ],
        ];

        foreach ($services as $data) {
            $checklist = $data['checklist'];
            unset($data['checklist']);

            $service = Service::create($data);

            foreach ($checklist as $i => $item) {
                ServiceChecklistItem::create([
                    'service_id'    => $service->id,
                    'content'       => $item['content'],
                    'section_group' => $item['section_group'] ?? null,
                    'sort_order'    => $i + 1,
                ]);
            }
        }
    }
}
