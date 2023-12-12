<?php

namespace App\Requests;

use App\Database\Connection;
use PDO;

abstract class Rule
{
    public static function unique($fieldName ,$value, $model)
    {
        $tableName = self::getTableName($model);
        $pdo = Connection::getPdo();
        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE $fieldName = :value";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(":value", $value);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $count = $result['count'];

        if ($count > 0)
        {
            return "This $fieldName is already taken. Please choose a different $fieldName.";

        }

        return null;
    }

    public static function required($value, $fieldName)
    {
        if (empty($value)) {
            return "The $fieldName field is required.";
        }

        return null;
    }

    public static function numeric($value, $fieldName)
    {
        if (!is_numeric($value)) {
            return "The $fieldName field must be numeric.";
        }

        return null;
    }

    private static function getTableName($class): string
    {
        $modelClassParts = explode('\\', $class);
        $className = end($modelClassParts);
        return strtolower($className) . 's';
    }
}