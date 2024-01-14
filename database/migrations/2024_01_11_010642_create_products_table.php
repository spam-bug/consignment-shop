<?php

use App\Models\Category;
use App\Models\Consignor;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Consignor::class);
            $table->foreignIdFor(Category::class)->nullable();
            $table->string('slug');
            $table->string('sku');
            $table->string('name');
            $table->text('description');
            $table->decimal('price');
            $table->integer('stock');
            $table->integer('stock_threshold');
            $table->json('photos');
            $table->string('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
