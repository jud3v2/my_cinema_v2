<?php

abstract class Model
{

    protected PDO $database;

    public function __construct()
    {
        $this->database = new PDO('mysql:host=localhost;dbname=cinema', 'root', '1234', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $this->database->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
    }

    protected string $table;

    protected function _findAll($limit = 10, $offset = 0): array
    {
        $query = $this->database->query("SELECT * FROM {$this->table} LIMIT $limit OFFSET $offset");
        return $query->fetchAll();
    }

    protected function _findById(int $id): array
    {
        $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    protected function _findByWhere($where): array
    {
        $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE $where");
        $query->execute();
        return $query->fetchAll();
    }

    protected function _delete(int $id): bool
    {
        $query = $this->database->prepare("DELETE user FROM user
            WHERE user.id = :id");
        return $query->execute(['id' => $id]);
    }

    protected function _create(array $data): void
    {
        $fields = array_keys($data);
        $values = array_map(fn($field) => ":$field", $fields);
        $fields = implode(', ', $fields);
        $values = implode(', ', $values);
        $query = $this->database->prepare("INSERT INTO {$this->table} ($fields) VALUES ($values)");
        $query->execute($data);
    }

    protected function _update(array $data): void
    {
        $fields = array_keys($data);
        $fields = array_map(fn($field) => "$field = :$field", $fields);
        $fields = implode(', ', $fields);
        $query = $this->database->prepare("UPDATE {$this->table} SET $fields WHERE id = :id");
        $query->execute($data);
    }

    public function _nameOfTable(): void
    {
        var_dump($this->table);
    }
}