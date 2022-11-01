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
        Schema::create('bid_products', function (Blueprint $table) {
            $table->increments('bid_id');
            $table->string('live_stream_id');
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_description');
            $table->string('product_image')->nullable();
            $table->decimal('product_price',$total = 8, $places = 2);
            $table->integer('product_sales_quantity');
            $table->integer('start_bid')->default('1');
            $table->integer('end_bid')->default('0');
            $table->timestamps();
            $table->foreign('live_stream_id')->references('live_stream_id')->on('lives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bid_products');
    }
};
