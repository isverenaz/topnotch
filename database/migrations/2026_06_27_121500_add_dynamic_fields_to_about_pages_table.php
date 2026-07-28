<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->json('hero_title')->nullable()->after('text');
            $table->json('hero_description')->nullable()->after('hero_title');
            $table->string('hero_image')->nullable()->after('hero_description');
            $table->json('stats')->nullable()->after('hero_image');
            $table->json('sections')->nullable()->after('stats');
            $table->json('cta_title')->nullable()->after('sections');
            $table->json('cta_text')->nullable()->after('cta_title');
            $table->json('cta_button_text')->nullable()->after('cta_text');
        });
    }

    public function down()
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title',
                'hero_description',
                'hero_image',
                'stats',
                'sections',
                'cta_title',
                'cta_text',
                'cta_button_text',
            ]);
        });
    }
};
