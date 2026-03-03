<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->json('label_json')->nullable()->after('label');
        });
        DB::statement("UPDATE stats SET label_json = json_object('az', label)");
        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn('label');
        });
        Schema::table('stats', function (Blueprint $table) {
            $table->renameColumn('label_json', 'label');
        });
    }

    public function down(): void {}
};
