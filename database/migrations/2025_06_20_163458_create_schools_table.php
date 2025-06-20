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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('country_id')->index()->nullable();
            $table->unsignedBigInteger('language_id')->index()->nullable();
            $table->unsignedBigInteger('parent_language_id')->index()->nullable();
            $table->unsignedBigInteger('teacher_id')->index()->nullable();
            $table->string('image',512)->nullable();
            $table->json('name');
            $table->json('slug');
            $table->json('text');
            $table->json('full_text')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_main')->default(0);
            $table->json('campaign')->nullable();
            $table->tinyInteger('is_campaign')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
