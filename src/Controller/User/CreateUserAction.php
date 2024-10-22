<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\Controller;
use App\Mapper\UserBaseMapper;
use App\Service\UserService;
use App\Validator\UserCreateValidator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class CreateUserAction extends Controller
{

    public function __construct(
        private UserService $userService,
        private UserBaseMapper $userBaseMapper,
        private UserCreateValidator $validator,
    )
    {
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $userData = $this->validator->validate($request->getParsedBody());
        $user = $this->userService->createUser($userData);

        return $this->successResponse(
            response: $response,
            data: ['user' => $this->userBaseMapper->map($user)],
            message: 'User created successfully'
        );
    }
}