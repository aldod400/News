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
        Schema::create('privacy_policy', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Multilingual title
            $table->json('content'); // Multilingual content
            $table->timestamp('last_updated')->nullable(); // When policy was last updated
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_policy');
    }
};
