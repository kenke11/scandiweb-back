<?php

namespace App\Database\Eloquent;

use App\Database\Connection;

abstract class Crud
{
    protected $data = [];

    protected function setData($data): void
    {
        $this->data = $data;
    }

    public static function all(): array
    {
        $tableName = self::getTableName();
        $pdo = Connection::getPdo();

        $statement = $pdo->query("SELECT * FROM {$tableName}");
        $itemRecords = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $items = [];
        foreach ($itemRecords as $itemData) {
            $crudInstance = new static();
            $crudInstance->setData($itemData);
            $items[] = $crudInstance;
        }

        return $items;
    }

    public static function with(array $relations): array
    {
        $tableName = self::getTableName();
        $pdo = Connection::getPdo();

        $statement = $pdo->query("SELECT * FROM $tableName");
        $itemRecords = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $items = [];
        foreach ($itemRecords as $itemData) {
            $crudInstance = new static();
            $crudInstance->setData($itemData);

            foreach ($relations as $relation) {
                $relatedTableName = $relation . 's'; // Assuming table names follow plural convention
                $relatedStatement = $pdo->prepare("SELECT * FROM $relatedTableName WHERE product_id = :id");
                $relatedStatement->execute(['id' => $itemData['id']]);
                $relatedData = $relatedStatement->fetch(\PDO::FETCH_ASSOC);
                if ($relatedData) {
                    $crudInstance->data[$relation] = $relatedData; // Assign related data to the current instance
                }
            }

            $items[] = $crudInstance;
        }

        return $items;
    }

    public static function create(array $data = []): Crud
    {
        $tableName = self::getTableName();
        $pdo = Connection::getPdo();

        $data['created_at'] = $data['created_at'] ?? date('Y-m-d H:i:s');
        $keys = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO $tableName ($keys) VALUES ($placeholders)";

        $statement = $pdo->prepare($query);
        $statement->execute($data);
        $id = $pdo->lastInsertId();

        return self::find($id);
    }

    public static function find($id)
    {
        $tableName = self::getTableName();
        $pdo = Connection::getPdo();

        $statement = $pdo->prepare("SELECT * FROM $tableName WHERE id = :id");
        $statement->execute(['id' => $id]);

        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        $crudInstance = new static();
        $crudInstance->setData($userData);

        return $crudInstance;
    }

    public static function where($key, $value): array
    {
        $tableName = self::getTableName();
        $pdo = Connection::getPdo();

        $statement = $pdo->prepare("SELECT * FROM $tableName WHERE $key = :value");
        $statement->execute(['value' => $value]);

        $itemRecords = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $items = [];
        foreach ($itemRecords as $itemData) {
            $crudInstance = new static();
            $crudInstance->setData($itemData);
            $items[] = $crudInstance;
        }

        return $items;
    }

    public function update(array $data): Crud
    {
        if (empty($this->data)) {
            exit();
        }

        $pdo = Connection::getPdo();
        $fields = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
        }

        $fieldsString = implode(', ', $fields);
        $tableName = self::getTableName();

        $query = "UPDATE $tableName SET $fieldsString WHERE id = :id";
        $data['id'] = $this->data['id'];

        $statement = $pdo->prepare($query);
        $statement->execute($data);
        return self::find($data['id']);
    }

    /**
     * @throws \Exception
     */
    public function delete(): void
    {
        if (empty($this->data)) {
            exit();
        }

        $pdo = Connection::getPdo();
        $tableName = self::getTableName();

        $statement = $pdo->prepare("DELETE FROM $tableName WHERE id = :id");
        $statement->execute(['id' => $this->data['id']]);
    }

    private static function getTableName(): string
    {
        $modelClass = get_called_class();
        $modelClassParts = explode('\\', $modelClass);
        $className = end($modelClassParts);
        return strtolower($className) . 's';
    }
}