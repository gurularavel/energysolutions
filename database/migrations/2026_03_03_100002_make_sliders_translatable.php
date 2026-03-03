<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // heading
        Schema::table('sliders', function (Blueprint $table) {
            $table->json('heading_json')->nullable()->after('heading');
        });
        DB::statement("UPDATE sliders SET heading_json = json_object('az', heading)");
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('heading');
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->renameColumn('heading_json', 'heading');
        });

        // button_text
        Schema::table('sliders', function (Blueprint $table) {
            $table->json('button_text_json')->nullable()->after('button_text');
        });
        DB::statement("UPDATE sliders SET button_text_json = json_object('az', button_text)");
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropColumn('button_text');
        });
        Schema::table('sliders', function (Blueprint $table) {
            $table->renameColumn('button_text_json', 'button_text');
        });
    }

    public function down(): void {}
};
