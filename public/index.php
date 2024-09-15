<?php

declare(strict_types=1);

require '../vendor/autoload.php';

use Slim\Factory\AppFactory;
use App\Database;

$app = AppFactory::create();
$database = new Database();

$app->post('/user', function ($request, $response) use ($database) {
    // Логика создания пользователя
});

$app->get('/user/{id}', function ($request, $response, $id) use ($database) {
    // Логика получения пользователя
});

$app->put('/user/{id}', function ($request, $response, $id) use ($database) {
    // Логика обновления пользователя
});

$app->delete('/user/{id}', function ($request, $response, $id) use ($database) {
    // Логика удаления пользователя
});

$app->run();
