<?php

declare(strict_types=1);

namespace App\Controller;

use App\Mapper\UserBaseMapper;
use App\Service\UserService;
use App\Validator\UserCreateValidator;
use App\Validator\UserUpdateValidator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
        private UserBaseMapper $userBaseMapper,
    )
    {
    }

    public function create(
        RequestInterface $request,
        ResponseInterface $response,
        UserCreateValidator $validator,
    ): ResponseInterface
    {
        $userData = $validator->validate($request->getParsedBody());
        $user = $this->userService->createUser($userData);

        return $this->successResponse(
            response: $response,
            data: $this->userBaseMapper->map($user),
            message: 'User created successfully'
        );
    }

    public function get(
        RequestInterface $request,
        ResponseInterface $response,
        array $args,
    ): ResponseInterface
    {
        $user     = $this->userService->getUser((int) $args['id']);
        $userData = null !== $user ? $this->userBaseMapper->map($user) : [];

        return $this->successResponse($response, $userData);
    }

    public function update(
        RequestInterface $request,
        ResponseInterface $response,
        array $args,
        UserUpdateValidator $validator
    ): ResponseInterface
    {
        $userData = $validator->validate($request->query->all());
        $user = $this->userService->updateUser((int) $args['id'], $userData);

        return $this->successResponse(
            response: $response,
            data: $this->userBaseMapper->map($user),
            message: 'User updated successfully'
        );
    }

    public function delete(
        RequestInterface $request,
        ResponseInterface $response,
        array $args,
    ): ResponseInterface
    {
        $this->userService->deleteUser((int) $args['id']);

        return $this->successResponse(
            response: $response,
            code: 204,
            message: 'User deleted successfully'
        );
    }
}