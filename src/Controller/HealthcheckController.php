<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\HealthcheckService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class HealthcheckController extends Controller
{
    public function __construct(
        private HealthcheckService $healthcheckService,
    )
    {
    }

    public function welcome(
        RequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface
    {
        return $this->successResponse($response, ['msg' => 'Welcome to OTUS User API']);
    }

    public function ping(
        RequestInterface $request,
        ResponseInterface $response,
    ): ResponseInterface
    {
        $isSuccess = $this->healthcheckService->ping();

        return $this->successResponse($response, ['pong' => $isSuccess]);
    }
}