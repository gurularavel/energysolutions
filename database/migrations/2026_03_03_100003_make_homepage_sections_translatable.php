<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // subtitle
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->json('subtitle_json')->nullable()->after('subtitle');
        });
        DB::statement("UPDATE homepage_sections SET subtitle_json = json_object('az', subtitle)");
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->dropColumn('subtitle');
        });
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->renameColumn('subtitle_json', 'subtitle');
        });

        // content
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->json('content_json')->nullable()->after('content');
        });
        DB::statement("UPDATE homepage_sections SET content_json = json_object('az', content)");
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->dropColumn('content');
        });
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->renameColumn('content_json', 'content');
        });

        // button_text
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->json('button_text_json')->nullable()->after('button_text');
        });
        DB::statement("UPDATE homepage_sections SET button_text_json = json_object('az', button_text)");
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->dropColumn('button_text');
        });
        Schema::table('homepage_sections', function (Blueprint $table) {
            $table->renameColumn('button_text_json', 'button_text');
        });
    }

    public function down(): void {}
};
