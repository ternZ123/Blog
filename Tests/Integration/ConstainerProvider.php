<?php

namespace Integration;

use DI\Container;

class ConstainerProvider
{
    private static Container $container;

    /**
     * @return Container
     */
    public static function getContainer(): Container
    {
        return self::$container;
    }

    /**
     * @param Container $container
     */
    public static function setContainer(Container $container): void
    {
        self::$container = $container;
    }
}