<?php

namespace Database\Seeders;

use App\Models\Stat;
use Illuminate\Database\Seeder;

class StatSeeder extends Seeder
{
    public function run(): void
    {
        $stats = [
            ['number' => 108, 'label' => 'Tamamlanmış Layihələr', 'speed' => 3000, 'sort_order' => 1],
            ['number' => 108, 'label' => 'Müştəri Məmnundur',     'speed' => 3000, 'sort_order' => 2],
            ['number' => 23,  'label' => 'İcra olunan Layihələr', 'speed' => 3000, 'sort_order' => 3],
        ];

        foreach ($stats as $data) {
            Stat::create($data);
        }
    }
}
