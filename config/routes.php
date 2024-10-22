<?php

declare(strict_types=1);

use App\Controller\HealthcheckController;
use App\Controller\User\CreateUserAction;
use App\Controller\User\DeleteUserAction;
use App\Controller\User\GetUserAction;
use App\Controller\User\GetUserListAction;
use App\Controller\User\UpdateUserAction;
use Slim\App;

return function (App $app): void {
    $app->get('/', HealthcheckController::class . ':welcome');
    $app->get('/api/ping', HealthcheckController::class . ':ping');

    $app->get('/api/users', GetUserListAction::class);
    $app->post('/api/users', CreateUserAction::class);
    $app->get('/api/users/{id:\d+}', GetUserAction::class);
    $app->put('/api/users/{id:\d+}', UpdateUserAction::class);
    $app->delete('/api/users/{id:\d+}', DeleteUserAction::class);
};