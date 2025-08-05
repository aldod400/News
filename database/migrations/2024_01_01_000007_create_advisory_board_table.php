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
        Schema::create('advisory_board', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // Multilingual name
            $table->json('job_title'); // Multilingual job title
            $table->string('image')->nullable(); // Profile image
            $table->integer('order')->default(0); // Display order
            $table->boolean('is_active')->default(true); // Active status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisory_board');
    }
};
