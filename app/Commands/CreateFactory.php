<?php

namespace App\Commands;

class CreateFactory
{
    public static function execute($factoryName)
    {
        $factoryContent = "<?php\n\nuse App\Models\\{$factoryName};\n\n// Your factory logic here\n";
        file_put_contents("database/factories/{$factoryName}Factory.php", $factoryContent);

        echo "Factory {$factoryName}Factory created successfully.\n";
    }
}