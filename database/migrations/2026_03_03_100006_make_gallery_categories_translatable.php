<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->json('name_json')->nullable()->after('name');
        });
        DB::statement("UPDATE gallery_categories SET name_json = json_object('az', name)");
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->dropColumn('name');
        });
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->renameColumn('name_json', 'name');
        });
    }

    public function down(): void {}
};
