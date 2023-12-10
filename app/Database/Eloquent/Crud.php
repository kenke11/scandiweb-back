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

    public static function create(array $data = []): Crud
    {
        $pdo = Connection::getPdo();

        $data['created_at'] = $data['created_at'] ?? date('Y-m-d H:i:s');

        $keys = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $query = "INSERT INTO users ($keys) VALUES ($placeholders)";

        $statement = $pdo->prepare($query);
        $statement->execute($data);

        $id = $pdo->lastInsertId();

        return self::find($id);
    }


    public static function find($id)
    {
        $pdo = Connection::getPdo();

        $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);

        $userData = $statement->fetch(\PDO::FETCH_ASSOC);

        $crudInstance = new static();
        $crudInstance->setData($userData);

        return $crudInstance;
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

        $query = "UPDATE users SET $fieldsString WHERE id = :id";
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

        $statement = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $statement->execute(['id' => $this->data['id']]);
    }
}