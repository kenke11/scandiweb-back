<?php

use App\Database\Migration;
use App\Database\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dvds', function ($table) {
            $table->increments('id');
            $table->number('product_id');
            $table->number('size');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dvds');
    }
};