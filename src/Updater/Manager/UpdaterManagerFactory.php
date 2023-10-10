<?php

namespace App\Updater\Manager;

use App\ServiceManager\Factory\FactoryInterface;
use App\Updater\Factory\UpdaterFactoryInterface;
use Psr\Container\ContainerInterface;
use DomainException;

class UpdaterManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, string $name, ...$args): mixed
    {
        if (! class_exists($name)) {
            throw new DomainException("UpdaterManager class `$name` dont exists");
        }

        if (! is_subclass_of($name, UpdaterManagerInterface::class)) {
            throw new DomainException("Unsupported UpdaterManager class `$name`");
        }

        if (0 === count($args)) {
            $updaterFactory = $container->get(UpdaterFactoryInterface::class);
        } else {
            $updaterFactory = array_shift($args);

            if (! ($updaterFactory instanceof UpdaterFactoryInterface)) {
                throw new DomainException("Unsupported UpdaterFactory class `$name`");
            }
        }

        return new $name($updaterFactory);
    }
}
