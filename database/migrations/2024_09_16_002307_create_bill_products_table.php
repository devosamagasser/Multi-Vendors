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
        Schema::create('bill_products', function (Blueprint $table) {
            // Define the foreign key for bill_id
            $table->foreignId('bill_id')
                ->constrained('bills')
                ->cascadeOnDelete();

            // Define the foreign key for product_id
            $table->foreignId('product_id')->nullable()
                ->constrained('products')
                ->nullOnDelete();
            // Other columns
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_compare_price');
            $table->smallInteger('quantity');

            // Define unique constraint on the combination of bill_id and product_id
            $table->unique(['bill_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_products');
    }
};
