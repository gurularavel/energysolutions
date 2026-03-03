<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['quote' => 'I was impresed by the company services, not lorem ipsum is simply free text of used. Neque porro est qui dolorem ipsum quia.', 'client_name' => 'Christine Rose', 'client_title' => 'Customer', 'sort_order' => 1],
            ['quote' => 'I was impresed by the company services, not lorem ipsum is simply free text of used. Neque porro est qui dolorem ipsum quia.', 'client_name' => 'Mike Hardson',   'client_title' => 'Customer', 'sort_order' => 2],
            ['quote' => 'I was impresed by the company services, not lorem ipsum is simply free text of used. Neque porro est qui dolorem ipsum quia.', 'client_name' => 'Christine Rose', 'client_title' => 'Customer', 'sort_order' => 3],
            ['quote' => 'I was impresed by the company services, not lorem ipsum is simply free text of used. Neque porro est qui dolorem ipsum quia.', 'client_name' => 'Mike Hardson',   'client_title' => 'Customer', 'sort_order' => 4],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create(array_merge($data, ['is_active' => true]));
        }
    }
}
