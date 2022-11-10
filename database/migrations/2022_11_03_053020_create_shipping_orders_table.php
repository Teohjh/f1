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
        Schema::create('shipping_orders', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->unsignedInteger('order_id');
            $table->string('provider_id');
            $table->string('fname');
            $table->string('lname');
            $table->integer('contact_no');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('postcode');
            $table->string('tracking_no')->nullable();
            $table->string('shipping_method');
            $table->string('shipping_status')->nullable()->default('Processing');
            $table->foreign('order_id')->references('order_id')->on('orders');
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
        Schema::dropIfExists('shipping_orders');
    }
};
