<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->string('sku',20);
            $table->string('name', 255);
            $table->string('description', 255);
            $table->integer('article');
            $table->integer('product_group_id');
            $table->string('color',15);
            $table->double('price');
            $table->double('tax');
            $table->double('discount');
            $table->integer('warranty_time');
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
}
