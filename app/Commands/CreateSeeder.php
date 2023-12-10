<?php

namespace App\Commands;

class CreateSeeder
{
    public static function execute($seederName)
    {
        $seederContent = "<?php\n\nuse App\Models\\{$seederName};\n\n// Your seeder logic here\n";
        file_put_contents("database/seeders/{$seederName}Seeder.php", $seederContent);

        echo "Seeder {$seederName}Seeder created successfully.\n";
    }
}