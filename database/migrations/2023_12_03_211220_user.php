<?php

use App\Database\Migration;
use App\Database\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};