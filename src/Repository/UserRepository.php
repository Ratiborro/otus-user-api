<?php

declare(strict_types=1);

namespace App\Repository;

use App\Infrastructure\Db\DbConnection;
use App\Infrastructure\Exception\DbException;

final readonly class UserRepository
{
    private DbConnection $dbConnection;

    public function __construct(DbConnection $dbConnection)
    {
        $this->dbConnection = $dbConnection;
    }

    public function find(int $id): array|false
    {
        $sql = '
            SELECT u."id", u."username", u."firstName", u."lastName", u."email", u."phone"
            FROM otus.users u
            WHERE u."id" = :id
        ';
        $result = $this->dbConnection->executeQuery($sql, ['id' => $id]);

        return $result->fetchAssociative();
    }

    /**
     * @param int[] $ids
     */
    public function findMany(array $ids): array
    {
        $sql = '
            SELECT u."id", u."username", u."firstName", u."lastName", u."email", u."phone"
            FROM otus.users u
            WHERE u."id" IN (:ids)
        ';
        $result = $this->dbConnection->executeQuery($sql, ['ids' => $ids]);

        return $result->fetchAllAssociative();
    }

    public function findAll(): array
    {
        $sql = '
            SELECT u."id", u."username", u."firstName", u."lastName", u."email", u."phone"
            FROM otus.users u
        ';
        $result = $this->dbConnection->executeQuery($sql, []);

        return $result->fetchAllAssociative();
    }

    public function create(array $data): array
    {
        $sql = '
            INSERT INTO otus.users ("username", "firstName", "lastName", "email", "phone")
            VALUES (:username, :firstName, :lastName, :email, :phone)
            ON CONFLICT ("email", "phone") 
            DO UPDATE SET 
                "firstName" = EXCLUDED."firstName",
                "lastName" = EXCLUDED."lastName"
            RETURNING "id"
        ';

        $values = [
            'username' => $data['username'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ];

        $result = $this->dbConnection->executeQuery($sql, $values)->fetchAssociative();
        if ($result === false) {
            throw new DbException('Failed to create user.');
        }

        $data['id'] = $result['id'];

        return $data;
    }

    public function update(int $id, array $data): array
    {
        $sql = '
            UPDATE otus.users u
            SET 
                "username" = :username,
                "firstName" = :firstName,
                "lastName" = :lastName,
                "email" = :email,
                "phone" = :phone
            WHERE u."id" = :id
        ';

        $values = [
            'username' => $data['username'],
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'id' => $id,
        ];

        $result = $this->dbConnection->executeStatement($sql, $values);
        if ($result !== 1) {
            throw new DbException('Failed to update user.');
        }

        $data['id'] = $id;

        return $data;
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM otus.users u WHERE u."id" = :id';

        $result = $this->dbConnection->executeStatement($sql, ['id' => $id]);
        if ($result !== 1) {
            throw new DbException('Failed to delete user.');
        }
    }
}
