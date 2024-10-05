<?php

declare(strict_types=1);

namespace App\Entity;

use InvalidArgumentException;

final readonly class User
{
    private int $id;
    private string $username;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $phone;

    public function __construct(
        int $id,
        string $username,
        string $firstName,
        string $lastName,
        string $email,
        string $phone
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}
