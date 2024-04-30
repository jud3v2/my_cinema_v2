<?php

include_once $_SERVER["DOCUMENT_ROOT"].'/Model/Model.php';
class Subscription extends Model
{
    protected string $table = 'membership';

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

        public function joinUserAndMembership(string $email): array
        {
                $sql = "SELECT * FROM cinema.user u
                JOIN cinema.membership m ON u.id = m.id_user
                JOIN cinema.subscription s ON m.id_subscription = s.id
                JOIN cinema.membership_log ml ON m.id = ml.id_membership
                JOIN movie m2 ON ml.id_session = m2.id
                WHERE u.email = :email
                AND m2.duration != 0";
                $query = $this->database->prepare($sql);
                $query->execute(['email' => $email]);
                return $query->fetchAll(PDO::FETCH_ASSOC);
        }
}