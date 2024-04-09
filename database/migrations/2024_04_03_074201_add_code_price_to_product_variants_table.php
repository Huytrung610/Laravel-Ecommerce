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
        if (!Schema::hasColumn('product_variants', 'code')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->string('code')->nullable()->after('id');
            });
        }
        if (!Schema::hasColumn('product_variants', 'slug')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->string('slug')->nullable();
            });
        }
        if (!Schema::hasColumn('product_variants', 'deleted_at')) {
            Schema::table('product_variants', function (Blueprint $table) {
                $table->string('deleted_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('slug');
            $table->dropColumn('deleted_at');
        });
    }
};
