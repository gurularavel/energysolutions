<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('service_supporting_images', function (Blueprint $table) {
            $table->string('after_group')->nullable()->after('service_id');
        });
    }

    public function down(): void
    {
        Schema::table('service_supporting_images', function (Blueprint $table) {
            $table->dropColumn('after_group');
        });
    }
};
