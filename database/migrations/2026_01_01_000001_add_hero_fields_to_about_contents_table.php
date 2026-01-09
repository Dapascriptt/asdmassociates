<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about_contents', function (Blueprint $table) {
            if (!Schema::hasColumn('about_contents', 'hero_title')) {
                $table->string('hero_title')->nullable()->after('hero_image');
            }
            if (!Schema::hasColumn('about_contents', 'hero_subtitle')) {
                $table->string('hero_subtitle')->nullable()->after('hero_title');
            }
            if (!Schema::hasColumn('about_contents', 'hero_points')) {
                $table->json('hero_points')->nullable()->after('hero_subtitle');
            }
        });
    }

    public function down(): void
    {
        Schema::table('about_contents', function (Blueprint $table) {
            $table->dropColumn(['hero_title', 'hero_subtitle', 'hero_points']);
        });
    }
};
