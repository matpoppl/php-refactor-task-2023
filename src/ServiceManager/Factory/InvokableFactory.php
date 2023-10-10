<?php

namespace App\ServiceManager\Factory;

use Psr\Container\ContainerInterface;

class InvokableFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, string $name, ...$args): mixed
    {
        if (! class_exists($name)) {
            throw new \DomainException("Service class `{$name}` dont exists");
        }

        return new $name(...$args);
    }
}
