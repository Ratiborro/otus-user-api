<?php

declare(strict_types=1);

namespace App\Infrastructure\Mapper;

use App\Entity\User;

final readonly class UserBaseMapper
{
    public function map(User $user): array
    {
        return [
            'id'        => $user->getId(),
            'username'  => $user->getUsername(),
            'firstName' => $user->getFirstName(),
            'lastName'  => $user->getLastName(),
            'email'     => $user->getEmail(),
            'phone'     => $user->getPhone(),
        ];
    }
}