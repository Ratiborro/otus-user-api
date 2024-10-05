<?php

declare(strict_types=1);

use App\Controller\UserController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes): void {
    $routes->add('get_user', '/api/users/{id}')
           ->methods(['GET'])
           ->controller([UserController::class, 'get'])
           ->requirements(['id' => '\d+']);

    $routes->add('create_user', '/api/users/{id}')
           ->methods(['POST'])
           ->controller([UserController::class, 'create'])
           ->requirements(['id' => '\d+']);

    $routes->add('update_user', '/api/users/{id}')
           ->methods(['PUT'])
           ->controller([UserController::class, 'update'])
           ->requirements(['id' => '\d+']);

    $routes->add('delete_user', '/api/users/{id}')
           ->methods(['DELETE'])
           ->controller([UserController::class, 'delete'])
           ->requirements(['id' => '\d+']);
};