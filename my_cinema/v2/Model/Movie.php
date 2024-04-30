<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Model.php';
class Movie extends Model
{
    protected string $table = 'movie';

    public function findMany($limit = 100, $offset = 0): array
    {
        return $this->_findAll($limit, $offset);
    }

    public function findOneById(int $id): array
    {
        return $this->_findById($id);
    }

    public function findByWhere($where): array
    {
        return $this->_findByWhere($where);
    }

    public function deleteOne(int $id): void
    {
        $this->_delete($id);
    }

    public function createOne(array $data): void
    {
        $this->_create($data);
    }

    public function updateOne(array $data): void
    {
        $this->_update($data);
    }
}