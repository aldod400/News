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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_category_id');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('parent_category_id')->references('id')->on('category')->onDelete('cascade');
            
            // Index for better performance
            $table->index('parent_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
