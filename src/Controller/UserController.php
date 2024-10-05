<?php

declare(strict_types=1);

namespace App\Controller;

use App\Mapper\UserBaseMapper;
use App\Service\UserService;
use App\Validator\UserCreateValidator;
use App\Validator\UserUpdateValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class UserController extends Controller
{
    public function __construct(
        private Request $request,
        private UserService $userService,
        private UserBaseMapper $userBaseMapper,
    )
    {
        parent::__construct($this->request);
    }

    public function create(UserCreateValidator $validator): Response
    {
        $userData = $validator->validate($this->request->query->all());
        $user = $this->userService->createUser($userData);

        return $this->successResponse(
            data: $this->userBaseMapper->map($user),
            message: 'User created successfully'
        );
    }

    public function get(string $id): Response
    {
        $user     = $this->userService->getUser((int) $id);
        $userData = $this->userBaseMapper->map($user);

        return $this->successResponse($userData);
    }

    public function update(string $id, UserUpdateValidator $validator): Response
    {
        $userData = $validator->validate($this->request->query->all());
        $user = $this->userService->updateUser((int) $id, $userData);

        return $this->successResponse(
            data: $this->userBaseMapper->map($user),
            message: 'User updated successfully'
        );
    }

    public function delete(string $id): Response
    {
        $this->userService->deleteUser((int) $id);

        return $this->successResponse(
            code: 204,
            message: 'User deleted successfully'
        );
    }
}