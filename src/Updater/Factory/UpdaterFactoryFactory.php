<?php

namespace App\Updater\Factory;

use App\ServiceManager\Factory\FactoryInterface;
use App\Updater\Result\ResultFactoryInterface;
use Psr\Container\ContainerInterface;
use DomainException;

class UpdaterFactoryFactory implements FactoryInterface
{
    public const SERVICE_CONFIG_KEY = 'updater_factory';

    public function __invoke(ContainerInterface $container, string $name, ...$args): mixed
    {
        if (! class_exists($name)) {
            throw new DomainException("UpdaterFactory class `$name` dont exists");
        }

        if (! is_subclass_of($name, UpdaterFactoryInterface::class)) {
            throw new DomainException("Unsupported UpdaterFactory class `$name`");
        }

        $options = null;
        $count = count($args);

        switch ($count) {
            case 0:
                $resultFactory = $container->get(ResultFactoryInterface::class);
                $options = self::extractOptions($container);
                break;
            case 1:
                $resultFactory = array_shift($args);
                $options = self::extractOptions($container);
                break;
            case 2:
                $resultFactory = array_shift($args);
                $options = array_shift($args);
                break;
            default:
                throw new \DomainException("Unsupported arguments count `{$count}` for service `{$name}`");
        }

        if (! ($resultFactory instanceof ResultFactoryInterface)) {
            throw new DomainException("Unsupported ResultFactory class `{$name}`");
        }

        if (! is_array($options)) {
            throw new DomainException("Unsupported UpdaterFactory options for service `{$name}`");
        }

        return new $name($resultFactory, $options);
    }

    public static function extractOptions(ContainerInterface $container): mixed
    {
        $config = $container->get('config');

        if (! array_key_exists(self::SERVICE_CONFIG_KEY, $config)) {
            return null;
        }

        $options = $config[self::SERVICE_CONFIG_KEY];

        return is_array($options) ? $options : null;
    }
}
