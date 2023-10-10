<?php

namespace App\Updater\Factory;

use App\ServiceManager\Factory\FactoryInterface;
use App\Updater\Result\ResultFactoryInterface;
use Psr\Container\ContainerInterface;
use DomainException;

class UpdaterFactoryFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, string $name, ...$args): mixed
    {
        if (! class_exists($name)) {
            throw new DomainException("UpdaterFactory class `$name` dont exists");
        }

        if (! is_subclass_of($name, UpdaterFactoryInterface::class)) {
            throw new DomainException("Unsupported UpdaterFactory class `$name`");
        }

        if (0 === count($args)) {
            $resultFactory = $container->get(ResultFactoryInterface::class);
        } else {
            $resultFactory = array_shift($args);

            if (! ($resultFactory instanceof ResultFactoryInterface)) {
                throw new DomainException("Unsupported ResultFactory class `$name`");
            }
        }

        return new UpdaterFactory($resultFactory);
    }
}
