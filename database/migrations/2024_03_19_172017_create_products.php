<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('short_des', 1000);
            $table->string('price', 100);
            $table->boolean('discount');
            $table->string('discount_price', 100);
            $table->string('image', 100);
            $table->boolean('stock');
            $table->float('star');
            $table->enum('remark', ['popular', 'new', 'top', 'special', 'trending','regular']);

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');

            $table->foreign('category_id')->references('id')->on('categories')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('brand_id')->references('id')->on('brands')->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
