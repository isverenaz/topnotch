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
        Schema::create('language_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id')->index();
            $table->unsignedBigInteger('parent_language_id')->index();
            $table->unsignedBigInteger('teacher_id')->index()->nullable();
            $table->string('image',512)->nullable();
            $table->json('name');
            $table->json('slug');
            $table->json('text');
            $table->json('full_text')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_main')->default(0);
            $table->string('campaign',100)->nullable();
            $table->tinyInteger('is_campaign')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('language_courses');
    }
};
