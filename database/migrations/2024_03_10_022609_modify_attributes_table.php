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
        $existingColumns = Schema::getColumnListing('attributes');

        $columnsToCheck = ['stock', 'price', 'sku', 'color', 'product_id', 'name'];

        $columnsToAdd = array_diff($columnsToCheck, $existingColumns);
        Schema::table('attributes', function (Blueprint $table) use ($columnsToAdd) {
            
            if (!Schema::hasColumn('attributes', 'name')) {
                $table->string('name')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn('name');

            $table->integer('stock')->notnull()->default('1');
            $table->float('price');
            $table->string('sku')->unique();
            $table->string('color');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};
