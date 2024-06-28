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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            //forgiens key
            $table->foreignId('brands_id')->nullable()->constrained('brands');
            $table->foreignId('category_id')->references('id')->on("categories");
            $table->foreignId('subcategory_id')->references('id')->on("subcategories");
            $table->foreignId('vendor_id')->nullable()->constrained('users');
            //---Product details--------
            $table->string("product_name");
            $table->string("product_slug");
            $table->string("product_code");
            $table->string("product_Qty");

            $table->string("product_size")->nullable();
            $table->string("product_color")->nullable();
            $table->string('product_tags')->nullable();


            $table->double("selling_price");
            $table->string("discount_price")->nullable();

            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->string('product_thumbnail');



            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();

            $table->integer('status')->default(0);
            $table->uuid('products_uuid')->unique();
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
