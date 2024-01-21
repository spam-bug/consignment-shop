<?php

use App\Models\Consignee;
use App\Models\Product;
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
        Schema::create('consignee_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Consignee::class);
            $table->foreignIdFor(Product::class);
            $table->integer('stock');
            $table->integer('stock_threshold')->nullable();
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consignee_products');
    }
};
