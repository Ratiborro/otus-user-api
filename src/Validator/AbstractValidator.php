<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\ValidationException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract readonly class AbstractValidator
{
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    abstract function getConstraints(): Collection;

    public function validate(array $data): array
    {
        $constraints = $this->getConstraints();
        $violations  = $this->validator->validate($data, $constraints);

        if (count($violations) > 0) {
            throw new ValidationFailedException($data, $violations);
        }

        return array_intersect_key($data, $constraints->fields);
    }
}