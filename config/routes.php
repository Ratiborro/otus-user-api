<?php

declare(strict_types=1);

use App\Controller\HealthcheckController;
use App\Controller\UserController;
use Slim\App;

return function (App $app): void {
    $app->get('/', HealthcheckController::class . ':welcome');
    $app->get('/api/ping', HealthcheckController::class . ':ping');

    $app->get('/api/users/{id}', UserController::class . ':get');
    $app->post('/api/users/{id}', UserController::class . ':create');
    $app->put('/api/users/{id}', UserController::class . ':update');
    $app->delete('/api/users/{id}', UserController::class . ':delete');
};