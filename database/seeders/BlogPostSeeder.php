<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title'        => 'Şamaxı-Qobustan ərazisində Bitum (neftli qum) yataqlarının geniş tədqiqatı',
                'published_at' => '2024-04-20',
                'sort_order'   => 1,
            ],
            [
                'title'        => 'Neft yataqlarının hasilatının artırılması məqsədi ilə mexaniki təsiri üsullarının tədbiqi və icra mexanizmi',
                'published_at' => '2024-03-15',
                'sort_order'   => 2,
            ],
            [
                'title'        => 'Tikinti, su xətlərinin çəkilişi maqistral yolların yenidən qurulması, su və kanalizasiya şəbəkələrinin qurulması məqsədi ilə kompleks Geoloji və Mühəndisi geoloji tədqiqatlar',
                'published_at' => '2024-06-10',
                'sort_order'   => 3,
            ],
        ];

        foreach ($posts as $data) {
            BlogPost::create(array_merge($data, ['is_active' => true]));
        }
    }
}
