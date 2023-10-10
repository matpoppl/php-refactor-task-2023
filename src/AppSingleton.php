<?php

namespace App;

use App\ServiceManager\ServiceManagerInterface;
use App\ServiceManager\ServiceManager;

class AppSingleton
{
    public static function getInstance(): static
    {
        static $instance = null;

        if (null === $instance) {
            $configPath = $_ENV['APP_CONFIG_PATH'] ?? __DIR__ . '/../configs/app.php';
            $instance = static::createNew(require($configPath));
        }

        return $instance;
    }

    public static function createNew(array $config): static
    {
        if (array_key_exists('service_manager', $config)) {
            $options = $config['service_manager'];
            unset($config['service_manager']);
        } else {
            $options = [];
        }

        $serviceManager = new ServiceManager($options);
        $serviceManager->setService('config', $config);
        return new static($serviceManager);
    }

    private function __construct(private ServiceManagerInterface $serviceManager)
    {
    }

    public function getService(string $id): mixed
    {
        return $this->serviceManager->get($id);
    }
}
