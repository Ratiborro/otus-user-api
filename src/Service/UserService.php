<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Infrastructure\List\UserList;
use App\Repository\UserRepository;

final readonly class UserService
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    /**
     * @param int[] $ids
     */
    public function getUsers(array $ids = []): UserList
    {
        $usersData = empty($ids)
            ? $this->userRepository->findAll()
            : $this->userRepository->findMany($ids);

        $userList = new UserList();
        foreach ($usersData as $userData) {
            $userList->add(
                new User(
                    $userData['id'],
                    $userData['username'],
                    $userData['firstName'],
                    $userData['lastName'],
                    $userData['email'],
                    $userData['phone']
                )
            );
        }

        return $userList;
    }

    public function getUser(int $id): ?User
    {
        $userData = $this->userRepository->find($id);
        if (false === $userData) {
            return null;
        }

        return new User(
            $userData['id'],
            $userData['username'],
            $userData['firstName'],
            $userData['lastName'],
            $userData['email'],
            $userData['phone']
        );
    }

    public function createUser(array $userData): User
    {
        $userData = $this->userRepository->create($userData);
        return new User(
            $userData['id'],
            $userData['username'],
            $userData['firstName'],
            $userData['lastName'],
            $userData['email'],
            $userData['phone']
        );
    }

    public function updateUser(int $id, array $userData): User
    {
        $userData = $this->userRepository->update($id, $userData);
        return new User(
            $userData['id'],
            $userData['username'],
            $userData['firstName'],
            $userData['lastName'],
            $userData['email'],
            $userData['phone']
        );
    }

    public function deleteUser(int $id): void
    {
        $this->userRepository->delete($id);
    }
}