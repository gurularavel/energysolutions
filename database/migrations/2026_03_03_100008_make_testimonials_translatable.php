<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // quote
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('quote_json')->nullable()->after('quote');
        });
        DB::statement("UPDATE testimonials SET quote_json = json_object('az', quote)");
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('quote');
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('quote_json', 'quote');
        });

        // client_name
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('client_name_json')->nullable()->after('client_name');
        });
        DB::statement("UPDATE testimonials SET client_name_json = json_object('az', client_name)");
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('client_name');
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('client_name_json', 'client_name');
        });

        // client_title
        Schema::table('testimonials', function (Blueprint $table) {
            $table->json('client_title_json')->nullable()->after('client_title');
        });
        DB::statement("UPDATE testimonials SET client_title_json = json_object('az', client_title)");
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn('client_title');
        });
        Schema::table('testimonials', function (Blueprint $table) {
            $table->renameColumn('client_title_json', 'client_title');
        });
    }

    public function down(): void {}
};
