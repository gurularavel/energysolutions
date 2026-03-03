<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // company_name
        Schema::table('site_settings', function (Blueprint $table) {
            $table->json('company_name_json')->nullable()->after('company_name');
        });
        DB::statement("UPDATE site_settings SET company_name_json = json_object('az', company_name)");
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('company_name');
        });
        Schema::table('site_settings', function (Blueprint $table) {
            $table->renameColumn('company_name_json', 'company_name');
        });

        // address
        Schema::table('site_settings', function (Blueprint $table) {
            $table->json('address_json')->nullable()->after('address');
        });
        DB::statement("UPDATE site_settings SET address_json = json_object('az', address)");
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('address');
        });
        Schema::table('site_settings', function (Blueprint $table) {
            $table->renameColumn('address_json', 'address');
        });

        // footer_copyright
        Schema::table('site_settings', function (Blueprint $table) {
            $table->json('footer_copyright_json')->nullable()->after('footer_copyright');
        });
        DB::statement("UPDATE site_settings SET footer_copyright_json = json_object('az', footer_copyright)");
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('footer_copyright');
        });
        Schema::table('site_settings', function (Blueprint $table) {
            $table->renameColumn('footer_copyright_json', 'footer_copyright');
        });

        // Add default_locale column
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('default_locale')->default('az')->after('policy_pdf');
        });
    }

    public function down(): void {}
};
