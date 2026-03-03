<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_checklist_items', function (Blueprint $table) {
            $table->json('content_json')->nullable()->after('content');
        });
        DB::statement("UPDATE service_checklist_items SET content_json = json_object('az', content)");
        Schema::table('service_checklist_items', function (Blueprint $table) {
            $table->dropColumn('content');
        });
        Schema::table('service_checklist_items', function (Blueprint $table) {
            $table->renameColumn('content_json', 'content');
        });
    }

    public function down(): void {}
};
