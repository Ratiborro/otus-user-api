<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\Controller;
use App\Infrastructure\Mapper\UserBaseMapper;
use App\Service\UserService;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final readonly class GetUserListAction extends Controller
{

    public function __construct(
        private UserService $userService,
        private UserBaseMapper $userBaseMapper,
    )
    {
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $users = $this->userService->getUsers();

        $usersData = [];
        foreach ($users as $user) {
            $usersData[] = $this->userBaseMapper->map($user);
        }

        return $this->successResponse($response, ['users' => $usersData]);
    }
}