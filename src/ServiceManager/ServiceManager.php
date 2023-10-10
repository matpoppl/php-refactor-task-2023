<?php

namespace App\ServiceManager;

use App\ServiceManager\Factory\FactoryInterface;

class ServiceManager implements ServiceManagerInterface
{
    private array $aliases;
    private array $factories;
    private array $services;

    public function __construct(array $options)
    {
        $this->aliases = $options['aliases'] ?? [];
        $this->factories = $options['factories'] ?? [];
        $this->services = $options['services'] ?? [];
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->aliases) || array_key_exists($id, $this->services) || array_key_exists($id, $this->factories);
    }

    public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new \DomainException("Service `{$id}` not found");
        }

        while (array_key_exists($id, $this->aliases)) {
            $id = $this->aliases[$id];
        }

        if (! array_key_exists($id, $this->services)) {
            $this->setService($id, $this->create($id));
        }

        return $this->services[$id];
    }

    public function create(string $id, ...$args): mixed
    {
        while (array_key_exists($id, $this->aliases)) {
            $id = $this->aliases[$id];
        }

        $factory = $this->getFactory($id, $args);

        return $factory($this, $id, ...$args);
    }

    public function setService(string $id, mixed $service): void
    {
        $this->services[$id] = $service;
    }

    public function getFactory(string $id): FactoryInterface
    {
        while (array_key_exists($id, $this->aliases)) {
            $id = $this->aliases[$id];
        }

        if (! array_key_exists($id, $this->factories)) {
            throw new \DomainException("Service factory `{$id}` not found");
        }

        $className = $this->factories[$id];

        if (! class_exists($className)) {
            throw new \DomainException("Factory class `{$className}` of service `{$id}` dont exists");
        }

        if (! is_subclass_of($className, FactoryInterface::class)) {
            throw new \DomainException("Unsupported factory class `{$className}` of service `{$id}`");
        }

        return new $className();
    }
}
