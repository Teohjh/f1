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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->increments('sales_order_id');
            $table->string('live_stream_id');
            $table->string('provider_id');
            $table->string('name');
            $table->unsignedInteger('bid_id');
            $table->string('comment_id');
            $table->integer('quantity');
            $table->decimal('total_amount',$total = 8, $places = 2);
            $table->enum('status',[['Paid','Unpaid']])->nullable()->default('Unpaid');  
            $table->timestamps();
            $table->foreign('live_stream_id')->references('live_stream_id')->on('lives');
            $table->foreign('bid_id')->references('bid_id')->on('bid_products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_orders');
    }
};
