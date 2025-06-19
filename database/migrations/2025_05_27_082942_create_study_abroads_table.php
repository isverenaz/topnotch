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
        Schema::create('study_abroads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->index();
            $table->unsignedBigInteger('university_id')->index();
            $table->unsignedBigInteger('degree_id')->index()->nullable();
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
        Schema::dropIfExists('study_abroads');
    }
};
