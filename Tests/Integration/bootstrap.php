<?php

use DI\ContainerBuilder;
use Integration\ConstainerProvider;

require __DIR__ . '/../../vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ .  '/../../config/di.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../.env');
$dotenv->load();

$container = $builder->build();

ConstainerProvider::setContainer($container);