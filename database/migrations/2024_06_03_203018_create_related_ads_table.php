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
        Schema::create('related_ads', function (Blueprint $table) {
            $table->foreignId('ad_id')->constrained()->onDelete('cascade');
            $table->foreignId('related_ad_id')->constrained('ads')->onDelete('cascade');
            $table->primary(['ad_id', 'related_ad_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('related_ads');
    }
};
