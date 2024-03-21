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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('total', 50);
            $table->string('vat', 100);
            $table->string('payable', 100);
            $table->string('cus_details', 100);
            $table->string('ship_details', 100);
            $table->string('tran_id', 100);
            $table->string('val_id', 100);
            $table->enum('delivery_status',["Pending","Processing", "Completed"]);
            $table->string('payment_status');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('invoices');
    }
};
