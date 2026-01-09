<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->nullable(); // perdata, pidana, korporasi, dll
            $table->string('position')->nullable(); // Partner / Associate
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('photo')->nullable();
            $table->text('overview')->nullable();
            $table->json('experience_highlights')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
