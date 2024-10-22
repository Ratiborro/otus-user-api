<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\Controller;
use App\Mapper\UserBaseMapper;
use App\Service\UserService;
use App\Validator\UserCreateValidator;
use App\Validator\UserUpdateValidator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class DeleteUserAction extends Controller
{

    public function __construct(
        private UserService $userService,
    )
    {
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $this->userService->deleteUser((int) $args['id']);

        return $this->successResponse(
            response: $response,
            code: 204,
            message: 'User deleted successfully'
        );
    }
}