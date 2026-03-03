<?php

namespace Database\Seeders;

use App\Models\HomepageSection;
use Illuminate\Database\Seeder;

class HomepageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'section_key' => 'about',
                'content'     => '" Energy Solutions" MMC 2020-ci ildən fəaliyyət göstərir və əsas fəaliyyət istiqaməti neft-qaz yataqlarının effektiv işlənməsini təmin etmək üçün zəruri geoloji-laboratoriya tədqiqatlarını aparır',
                'button_text' => 'Ətraflı',
                'button_link' => '#',
            ],
            [
                'section_key' => 'slogan1',
                'content'     => 'Biliyin Yeganə Mənbəyi Təcrübədir.',
            ],
            [
                'section_key' => 'slogan2',
                'content'     => 'Ən yaxşı sınaq işlərini <span>və</span><br>laboratoriya tədqiqatlarını<br> təqdim edirik',
                'button_text' => 'Ətraflı',
                'button_link' => '#',
            ],
            [
                'section_key' => 'cert_text',
                'content'     => 'Qeyd edilən bütün xidmətlər yüksək ixtisaslı və sertifikatlaşdırılmış mütəxəssislər tərəfindən İSO standartlarının tələblərinə uyğun aparılır. Şirkətimiz İSO 9001, 14001, 45001 sertifikatlarına, Lisenziyalara və Akkreditasiya sənədlərinə malikdir və bütün xidmətlərimizdə bu tələblərə ciddi əməl olunur.',
                'button_text' => 'Ətraflı',
                'button_link' => '/certificates',
            ],
            [
                'section_key' => 'future_services',
                'content'     => 'Gələcəkdə göstərmək istədiyimiz xidmətlər',
                'button_text' => 'Ətraflı',
                'button_link' => '#',
            ],
        ];

        foreach ($sections as $data) {
            HomepageSection::updateOrCreate(['section_key' => $data['section_key']], $data);
        }
    }
}
