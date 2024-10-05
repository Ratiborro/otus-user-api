<?php

declare(strict_types=1);

namespace App\Validator;

use App\Validator\Rule\MobilePhone;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

final readonly class UserUpdateValidator extends AbstractValidator
{
    public function getConstraints(): Collection
    {
        return new Collection([
            'username' => [
                new NotBlank(),
                new Length(['min' => 1, 'max' => 100]),
            ],
            'firstName' => [
                new NotBlank(),
                new Length(['min' => 1, 'max' => 100]),
            ],
            'lastName' => [
                new NotBlank(),
                new Length(['min' => 1, 'max' => 100]),
            ],
            'email' => [
                new NotBlank(),
                new Email(),
            ],
            'phone' => [
                new NotBlank(),
                new MobilePhone(),
            ],
        ]);
    }
}