<?php

declare(strict_types=1);

namespace App\Repository;

use App\Infrastructure\Db\DbConnection;
use RuntimeException;

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
            SELECT u."id", u."username", u."first_name", u."last_name", u."email", u."phone"
            FROM otus.users u
            WHERE u.id = :id
        ';
        $result = $this->dbConnection->executeQuery($sql, ['id' => $id]);
        return $result->fetchOne();
    }

    public function create(array $data): array
    {
        $sql = '
            INSERT INTO otus.users ("username", "first_name", "last_name", "email", "phone")
            VALUES (:username, :firstName, :lastName, :email, :phone)
            ON CONFLICT ("email", "phone") 
            DO UPDATE SET 
                "first_name" = EXCLUDED."first_name",
                "last_name" = EXCLUDED."last_name"
            RETURNING id
        ';

        $values = [
            'username' => $data['username'],
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ];

        $result = $this->dbConnection->executeQuery($sql, $values)->fetchAssociative();
        if ($result === false) {
            throw new RuntimeException('Failed to create user.');
        }

        $data['id'] = $result['id'];

        return $data;
    }

    public function update(int $id, array $data): array
    {
        $sql = '
            UPDATE otus.users u
            SET 
                username = :username,
                first_name = :firstName,
                last_name = :lastName,
                email = :email,
                phone = :phone
            WHERE u.id = :id
        ';

        $values = [
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'id' => $id,
        ];

        $result = $this->dbConnection->executeStatement($sql, $values);
        if ($result !== 1) {
            throw new RuntimeException('Failed to update user.');
        }

        return $data;
    }

    public function delete(int $id): void
    {
        $sql = 'DELETE FROM otus.users u WHERE u.id = :id';

        $result = $this->dbConnection->executeStatement($sql, ['id' => $id]);
        if ($result !== 1) {
            throw new RuntimeException('Failed to delete user.');
        }
    }
}
