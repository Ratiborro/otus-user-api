<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

readonly class Controller
{
    public function __construct(
        private Request $request
    )
    {
    }

    protected function successResponse(array $data = [], int $code = 200, string $message = null): JsonResponse
    {
        return new JsonResponse([
            'meta' => [
                'code'    => $code,
                'message' => $data,
            ],
            'data' => $data
        ]);
    }
}