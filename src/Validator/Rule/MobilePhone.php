<?php

declare(strict_types=1);

namespace App\Validator\Rule;

use Symfony\Component\Validator\Constraint;

class MobilePhone extends Constraint
{
    public string $message = 'The phone number "{{ value }}" is not a valid mobile phone number.';

    public function validatedBy(): string
    {
        return MobilePhoneValidator::class;
    }
}