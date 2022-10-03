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
            $table->id()->unique();
            $table->string('product_code');
            $table->string('product_name');
            $table->string('product_description');
            $table->string('product_image');
            $table->decimal('product_price',$total = 8, $places = 2);
            $table->integer('product_stock_quantity');
            $table->string('product_status')->nullable()->default('Shown');
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
        Schema::dropIfExists('products');
    }
};
