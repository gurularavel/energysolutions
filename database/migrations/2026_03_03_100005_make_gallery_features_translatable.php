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
        Schema::table('gallery_features', function (Blueprint $table) {
            $table->json('title_json')->nullable()->after('title');
        });
        DB::statement("UPDATE gallery_features SET title_json = json_object('az', title)");
        Schema::table('gallery_features', function (Blueprint $table) {
            $table->dropColumn('title');
        });
        Schema::table('gallery_features', function (Blueprint $table) {
            $table->renameColumn('title_json', 'title');
        });

        // description
        Schema::table('gallery_features', function (Blueprint $table) {
            $table->json('description_json')->nullable()->after('description');
        });
        DB::statement("UPDATE gallery_features SET description_json = json_object('az', description)");
        Schema::table('gallery_features', function (Blueprint $table) {
            $table->dropColumn('description');
        });
        Schema::table('gallery_features', function (Blueprint $table) {
            $table->renameColumn('description_json', 'description');
        });
    }

    public function down(): void {}
};
