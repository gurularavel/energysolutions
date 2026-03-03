<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_supporting_images', function (Blueprint $table) {
            $table->json('alt_text_json')->nullable()->after('alt_text');
        });
        DB::statement("UPDATE service_supporting_images SET alt_text_json = json_object('az', alt_text)");
        Schema::table('service_supporting_images', function (Blueprint $table) {
            $table->dropColumn('alt_text');
        });
        Schema::table('service_supporting_images', function (Blueprint $table) {
            $table->renameColumn('alt_text_json', 'alt_text');
        });
    }

    public function down(): void {}
};
