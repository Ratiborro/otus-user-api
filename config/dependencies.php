<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Validation;

return [
    ValidatorInterface::class => function (ContainerInterface $container) {
        return Validation::createValidator();
    },
];
