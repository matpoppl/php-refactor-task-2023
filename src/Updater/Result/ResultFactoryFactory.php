<?php

namespace App\Updater\Result;

use App\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use DomainException;

class ResultFactoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, string $name, ...$args): mixed
    {
        if (! class_exists($name)) {
            throw new DomainException("ResultFactory class `$name` dont exists");
        }

        if (! is_subclass_of($name, ResultFactoryInterface::class)) {
            throw new DomainException("ResultFactory UpdaterManager class `$name`");
        }

        return new $name();
    }
}
