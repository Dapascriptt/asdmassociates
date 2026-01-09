<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            if (!Schema::hasColumn('galleries', 'title')) {
                $table->string('title')->nullable()->after('id');
            }

            if (!Schema::hasColumn('galleries', 'image')) {
                $table->string('image')->after('title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            if (Schema::hasColumn('galleries', 'image')) {
                $table->dropColumn('image');
            }
            if (Schema::hasColumn('galleries', 'title')) {
                $table->dropColumn('title');
            }
        });
    }
};
