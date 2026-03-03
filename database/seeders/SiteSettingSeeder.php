<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate([], [
            'company_name'        => 'Energy Solutions MMC',
            'phone'               => '(+994 10) 225-24-78',
            'email'               => 'office@energysolutions.az',
            'address'             => 'Bəhruz Nuriyev 1/77, Nizami r, Bakı, Azərbaycan',
            'facebook_url'        => 'https://www.facebook.com/profile.php?id=61554334406994&locale=az_AZ',
            'twitter_url'         => null,
            'instagram_url'       => null,
            'pinterest_url'       => null,
            'youtube_url'         => null,
            'footer_copyright'    => 'Copyright &copy; 2024 <a href="https://itnom.com">IT-NOM</a> All Rights Reserved.',
            'complaint_form_pdf'  => 'assets/form/esslfform.pdf',
            'order_form_pdf'      => 'assets/form/orderformenergysol.pdf',
            'policy_pdf'          => 'assets/policy/Policy.pdf',
        ]);
    }
}
