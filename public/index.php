<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

require '../vendor/autoload.php';

const ROOT_DIR = __DIR__;
const CONFIG_DIR = ROOT_DIR . '/../config/';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(require CONFIG_DIR . 'dependencies.php');

// Если нужен кэш контейнера (для production)
// $containerBuilder->enableCompilation(DIR . '/var/cache');

$container = $containerBuilder->build();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->addErrorMiddleware(true, true, true)
    ->setDefaultErrorHandler(
        function (
            ServerRequestInterface $request,
            Throwable              $exception,
            bool                   $displayErrorDetails,
            bool                   $logErrors,
            bool                   $logErrorDetails
        ) use ($app): ResponseInterface {
            $response = $app->getResponseFactory()->createResponse();
            $code = $exception->getCode();
            $statusCode = $code < 200 || $code > 599 ? 500 : $code;

            $response->getBody()->write(json_encode([
                'code'    => $statusCode,
                'message' => $exception->getMessage(),
            ]));

            return $response->withHeader('Content-Type', 'application/json')
                            ->withStatus($statusCode);
        }
    );
// Преобразование warning-ов и других ошибок в исключения
set_error_handler(function ($errno, $msg, $file, $line) {
    $file = basename($file);
    throw new ErrorException("$msg ($file:$line)", 0, $errno, $file, $line);
});

$routesConfigurator = require CONFIG_DIR . 'routes.php';
$routesConfigurator($app);

$app->run();