<?php

use App\Database\Migration;
use App\Database\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('furnitures', function ($table) {
            $table->increments('id');
            $table->number('product_id')->unique();
            $table->number('height');
            $table->number('width');
            $table->number('length');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('furnitures');
    }
};