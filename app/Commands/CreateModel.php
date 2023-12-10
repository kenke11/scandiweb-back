<?php

namespace App\Commands;

class CreateModel
{
    public static function execute($modelName)
    {
        $commandFileDir = 'app/Commands/commands.php';

        // Generate migration
        exec("php $commandFileDir make:migration $modelName");

        // Generate seeder
        exec("php $commandFileDir make:seeder {$modelName}Seeder");

        // Generate factory
        exec("php $commandFileDir make:factory {$modelName}Factory");

        // Generate model
        $modelContent = "<?php\n\nnamespace App\Models;\n\nclass {$modelName} {}\n";
        file_put_contents("app/Models/{$modelName}.php", $modelContent);

        echo "Model, Migration, Seeder, and Factory for {$modelName} created successfully.\n";
    }
}