<?php

declare(strict_types=1);

namespace App\Service;

final readonly class HealthcheckService
{
    public function ping(): true
    {
        return true;
    }
}