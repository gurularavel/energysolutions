<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->json('title_json')->nullable()->after('title');
        });
        DB::statement("UPDATE blog_posts SET title_json = json_object('az', title)");
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('title');
        });
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->renameColumn('title_json', 'title');
        });
    }

    public function down(): void {}
};
