<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'heading'     => "QEYRİ ƏNƏNƏVİ\nYANAR FAYDALI\nQAZINTILAR",
                'button_text' => 'Ətraflı',
                'button_link' => '/services/unconventional-minerals',
                'sort_order'  => 1,
                'is_active'   => true,
            ],
            [
                'heading'     => "KERN VƏ ŞLAM\nNÜMUNƏ\nTƏDQİQATLARI",
                'button_text' => 'Ətraflı',
                'button_link' => '/services/core-sample-research',
                'sort_order'  => 2,
                'is_active'   => true,
            ],
            [
                'heading'     => "NEFT, SU VƏ QAZIN\nÜMUMİ\nANALİZİ",
                'button_text' => 'Ətraflı',
                'button_link' => '/services/oil-water-gas-analysis',
                'sort_order'  => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($sliders as $data) {
            Slider::create($data);
        }
    }
}
