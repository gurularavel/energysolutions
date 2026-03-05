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
        Schema::table('service_checklist_items', function (Blueprint $table) {
            $table->string('item_type')->default('list')->after('section_group');
            // list      = adi bullet point
            // text_image = solda text, sağda şəkil (col-xl-6 + col-xl-6)
        });
    }

    public function down(): void
    {
        Schema::table('service_checklist_items', function (Blueprint $table) {
            $table->dropColumn('item_type');
        });
    }
};
