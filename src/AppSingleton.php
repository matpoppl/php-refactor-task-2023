<?php

namespace App;

use App\ServiceManager\ServiceManagerInterface;
use App\ServiceManager\ServiceManager;

class AppSingleton
{
    public static function getInstance(): self
    {
        static $instance = null;

        if (null === $instance) {
            $configPath = $_ENV['APP_CONFIG_PATH'] ?? __DIR__ . '/../configs/app.php';
            if (! file_exists($configPath)) {
                throw new \UnexpectedValueException("Config file `{$configPath}` dont exists");
            }
            $config = require $configPath;
            $instance = static::createNew($config);
        }

        return $instance;
    }

    public static function createNew(array $config): self
    {
        if (array_key_exists('service_manager', $config)) {
            $options = $config['service_manager'];
            unset($config['service_manager']);
        } else {
            $options = [];
        }

        $serviceManager = new ServiceManager($options);
        $serviceManager->setService('config', $config);
        return new self($serviceManager);
    }

    private function __construct(private ServiceManagerInterface $serviceManager)
    {
    }

    public function getService(string $id): mixed
    {
        return $this->serviceManager->get($id);
    }
}
