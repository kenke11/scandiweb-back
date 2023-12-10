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
            $table->string('email');
            $table->timestamp('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};