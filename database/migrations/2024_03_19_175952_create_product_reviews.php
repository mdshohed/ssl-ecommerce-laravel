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
        Schema::create('product_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('description', 100);
            $table->string('rating', 100);

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');

            $table->foreign('product_id')->references('id')->on('products')
                ->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('customer_id')->references('id')->on('customer_profiles')
                ->restrictOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('product_reviews');
    }
};
