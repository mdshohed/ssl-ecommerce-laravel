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
        Schema::create('sslcommerz_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('store_id');
            $table->string('store_password');
            $table->string('currency');
            $table->string('success_url');
            $table->string('fail_url');
            $table->string('cancel_url');
            $table->string('ipn_url');
            $table->string('init_url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sslcommerz_accounts');
    }
};
