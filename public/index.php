<?php

declare(strict_types=1);

use DI\ContainerBuilder;
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

$routesConfigurator = require CONFIG_DIR . 'routes.php';
$routesConfigurator($app);

$app->run();