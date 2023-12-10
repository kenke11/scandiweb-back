<?php

use App\Database\Migration;
use App\Database\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function ($table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->string('name');
            $table->number('price');
            $table->enum('product_type', ['dvd', 'book', 'furniture']);
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};