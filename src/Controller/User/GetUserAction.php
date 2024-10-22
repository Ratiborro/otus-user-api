<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\Controller;
use App\Exception\UserNotFoundException;
use App\Mapper\UserBaseMapper;
use App\Service\UserService;
use App\Validator\UserCreateValidator;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class GetUserAction extends Controller
{

    public function __construct(
        private UserService $userService,
        private UserBaseMapper $userBaseMapper,
    )
    {
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $user = $this->userService->getUser((int) $args['id']);
        if (null === $user) {
            throw new UserNotFoundException('User not found');
        }

        $userData = $this->userBaseMapper->map($user);

        return $this->successResponse($response, ['user' => $userData]);
    }
}