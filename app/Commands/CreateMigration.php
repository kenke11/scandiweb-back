<?php

namespace App\Commands;

class CreateMigration
{
    public static function execute($migrationName)
    {
        $timestamp = date('Y_m_d_His');
        $tableName = strtolower($migrationName) . 's';
        $migrationContent = "<?php\n\nuse App\Database\Migration;\nuse App\Database\Schema;\n\nreturn new class extends Migration\n{\n    public function up()\n    {\n        Schema::create('$tableName', function (\$table) {\n            \$table->increments('id');\n            \$table->string('name');\n        });\n    }\n\n    public function down()\n    {\n        Schema::dropIfExists('$tableName');\n    }\n};\n";

        $name = strtolower($migrationName);
        file_put_contents("database/migrations/{$timestamp}_$name.php", $migrationContent);

        echo "Migration {$timestamp}_{$tableName} created successfully.\n";
    }
}