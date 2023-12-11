<?php

use App\Database\Migration;
use App\Database\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('books', function ($table) {
            $table->increments('id');
            $table->number('product_id')->unique();
            $table->number('weight');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
};