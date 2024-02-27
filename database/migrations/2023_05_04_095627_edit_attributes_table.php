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
            foreach ($columnsToAdd as $column) {
                if ($column === 'stock') {
                    $table->integer('stock')->notnull()->default('1');
                } elseif ($column === 'price') {
                    $table->float('price');
                } elseif ($column === 'sku') {
                    $table->string('sku')->unique();
                } elseif ($column === 'color') {
                    $table->string('color');
                } elseif ($column === 'product_id') {
                    $table->unsignedBigInteger('product_id')->nullable();
                    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
                } 
            }
            if (Schema::hasColumn('attributes', 'name')) {
                $table->dropColumn('name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('stock');
            $table->dropColumn('price');
            $table->dropColumn('sku');
            $table->dropColumn('color');
        });
    }
};
