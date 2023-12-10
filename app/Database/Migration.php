<?php

namespace App\Database;

abstract class Migration {
    public abstract function up();

    public abstract function down();
}