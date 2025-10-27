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
    Schema::create('tomato_plant_images', function (Blueprint $table) {
    $table->id('image_id');
    $table->foreignId('farmer_id')->constrained('users', 'farmer_id')->onDelete('cascade');
    $table->string('filepath');
    $table->boolean('status')->default(true); // Assuming 'status' means active/inactive
    $table->timestamps(); // This handles 'CreatedAt'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tomato_plant_images');
    }
};
