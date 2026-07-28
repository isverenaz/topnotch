<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commits', function (Blueprint $table) {
            $table->string('image', 512)->nullable()->after('id');
            $table->dateTime('datetime')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('commits', function (Blueprint $table) {
            $table->dropColumn(['image', 'datetime']);
        });
    }
};
