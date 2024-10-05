<?php

declare(strict_types=1);

use DI\ContainerBuilder;

require '../vendor/autoload.php';

const ROOT_DIR = __DIR__;
const CONFIG_DIR = __DIR__ . '/config/';

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions(require CONFIG_DIR . '/dependencies.php');

// Если нужен кэш контейнера (для production)
// $containerBuilder->enableCompilation(DIR . '/var/cache');

$container = $containerBuilder->build();
