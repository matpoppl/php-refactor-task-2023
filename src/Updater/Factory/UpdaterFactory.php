<?php

namespace App\Updater\Factory;

use App\Updater\UpdaterInterface;
use App\Updater\Result\ResultFactoryInterface;

class UpdaterFactory implements UpdaterFactoryInterface
{
    private string $defaultUpdater;
    private array $updaterAliases;
    private ResultFactoryInterface $resultFactory;

    public function __construct(ResultFactoryInterface $resultFactory, array $options)
    {
        $this->resultFactory = $resultFactory;
        $this->defaultUpdater = $options['default_updater'] ?? null;
        $this->updaterAliases = $options['aliases'] ?? null;
    }

    public function createUpdater(string $alias): UpdaterInterface
    {
        $className = $this->updaterAliases[$alias] ?? $this->defaultUpdater;

        if (! class_exists($className)) {
            throw new \UnexpectedValueException("Updater class `{$className}` dont exists");
        }

        if (! is_subclass_of($className, UpdaterInterface::class)) {
            throw new \UnexpectedValueException("Unsupported updater class `{$className}`");
        }

        return new $className($this->resultFactory);
    }
}
