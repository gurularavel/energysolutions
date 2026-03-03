<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // title
        Schema::table('service_accordion_sections', function (Blueprint $table) {
            $table->json('title_json')->nullable()->after('title');
        });
        DB::statement("UPDATE service_accordion_sections SET title_json = json_object('az', title)");
        Schema::table('service_accordion_sections', function (Blueprint $table) {
            $table->dropColumn('title');
        });
        Schema::table('service_accordion_sections', function (Blueprint $table) {
            $table->renameColumn('title_json', 'title');
        });

        // content
        Schema::table('service_accordion_sections', function (Blueprint $table) {
            $table->json('content_json')->nullable()->after('content');
        });
        DB::statement("UPDATE service_accordion_sections SET content_json = json_object('az', content)");
        Schema::table('service_accordion_sections', function (Blueprint $table) {
            $table->dropColumn('content');
        });
        Schema::table('service_accordion_sections', function (Blueprint $table) {
            $table->renameColumn('content_json', 'content');
        });
    }

    public function down(): void {}
};
