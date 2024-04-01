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
        Schema::create('product_variant_attribute_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_variant_id')->nullable();
            $table->unsignedBigInteger('attribute_value_id')->nullable();
        
            // Thêm foreign key
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('set null');
            $table->foreign('attribute_value_id')->references('id')->on('attribute_values')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variant_attribute_value');
    }
};
