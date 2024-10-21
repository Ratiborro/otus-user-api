<?php

declare(strict_types=1);

namespace App\Controller;

use Psr\Http\Message\ResponseInterface;

readonly class Controller
{
    protected function successResponse(ResponseInterface $response, array $data = [], int $code = 200, string $message = null): ResponseInterface
    {
        $response->getBody()->write(
            json_encode([
                'meta' => [
                    'code'    => $code,
                    'message' => $message,
                ],
                'data' => $data
            ])
        );

        return $response;
    }
}