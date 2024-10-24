<?php

declare(strict_types=1);

namespace App\Infrastructure\Exception;

use Exception;

class NotFoundException extends Exception
{
    protected $code = 404;
}