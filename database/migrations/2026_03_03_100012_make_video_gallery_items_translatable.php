<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('video_gallery_items', function (Blueprint $table) {
            $table->json('title_json')->nullable()->after('title');
        });
        DB::statement("UPDATE video_gallery_items SET title_json = json_object('az', title)");
        Schema::table('video_gallery_items', function (Blueprint $table) {
            $table->dropColumn('title');
        });
        Schema::table('video_gallery_items', function (Blueprint $table) {
            $table->renameColumn('title_json', 'title');
        });
    }

    public function down(): void {}
};
