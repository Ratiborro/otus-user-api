<?php

declare(strict_types=1);

namespace App\Infrastructure\Validator\Rule;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MobilePhoneValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!preg_match('/^\+7[0-9]{10}$/', $value)) {
            /* @var MobilePhone $constraint */
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ value }}', $value)
                          ->addViolation();
        }
    }
}