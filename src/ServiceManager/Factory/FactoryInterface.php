<?php

namespace App\ServiceManager\Factory;

use Psr\Container\ContainerInterface;

interface FactoryInterface
{
    public function __invoke(ContainerInterface $container, string $name, ...$args): mixed;
}
