<?php

namespace App\Models;

use App\Database\Connection;
use Database\Factories\UserFactory;

abstract class Model
{
    public static function factory($count = 1)
    {
        $modelClass = get_called_class();
        $modelClassParts = explode('\\', $modelClass);
        $className = end($modelClassParts);

        $factoryClass = self::getFactoryClass($className);
        $tableName = strtolower($className) . 's';

        if (class_exists($factoryClass)) {
            for ($i = 0; $i < $count; $i++) {
                set_error_handler(function ($errno, $errstr, $errfile, $errline) {
                });
                $factory = new $factoryClass;
                $factoryData = $factory->definition();
                self::createData($factoryData, $tableName);
            }

        } else {
            throw new \Exception('Factory not found for ' . $modelClass);
        }
    }

    private static function getFactoryClass($className): string
    {
        $factoryNamespace = 'Database\Factories\\';
        return $factoryNamespace . $className . 'Factory';
    }

    private static function createData($data, $tableName)
    {
        $keys = '';
        $values = '';

        foreach ($data as $key => $value){
            $keys = !!$keys ? $keys . ', ' . $key : $key;
            $values = !!$values ? $values . ', ' . '\'' . $value . '\'' : '\'' . $value . '\'';
        }

        $pdo = Connection::getPdo();
        $pdo->query("INSERT INTO $tableName (" . $keys . ", created_at) VALUES ($values, NOW())");
    }
}