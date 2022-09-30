<?php

declare(strict_types=1);

use Blog\Database;
use Blog\Twig\AssetExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\get;

return [
    'server.params'=>$_SERVER,
    FilesystemLoader::class=> autowire()
    ->constructorParameter('paths','templates'),

    Environment::class=> autowire()
        ->constructorParameter('loader', get(FilesystemLoader::class))
        ->method('addExtension',get(AssetExtension::class)),

    Database::class=>autowire()
        ->constructorParameter('connection',get(PDO::class)),

    PDO::class=>autowire()
    ->constructor(
        $_ENV['DATABASE_DSN'],
        $_ENV['DATABASE_USERNAME'],
        $_ENV['DATABASE_PASSWORD'],
        []
    )
    ->method('setAttribute',PDO::ERRMODE_EXCEPTION,PDO::ATTR_ERRMODE)
    ->method('setAttribute',PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC),

    AssetExtension::class=>autowire()
    ->constructorParameter('serverParams',get('server.params')),
];