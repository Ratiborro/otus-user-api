<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;

class ValidationException extends Exception
{
    protected $code = 422;
}