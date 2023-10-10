<?php

namespace App\ServiceManager;

use App\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

interface ServiceManagerInterface extends ContainerInterface
{
    public function create(string $id, ...$args): mixed;

    public function setService(string $id, mixed $service): void;

    public function getFactory(string $id): FactoryInterface;
}
