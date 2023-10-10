<?php

use App\Updater\Factory;
use App\Updater\Manager;
use App\Updater\Result;

return [
    'service_manager' => [
        'aliases' => [
            'updater.result.factory' => Result\ResultFactoryInterface::class,
            Result\ResultFactoryInterface::class => Result\ResultFactory::class,
            'updater.manager' => Manager\UpdaterManagerInterface::class,
            Manager\UpdaterManagerInterface::class => Manager\UpdaterManager::class,
            'updater.factory' => Factory\UpdaterFactoryInterface::class,
            Factory\UpdaterFactoryInterface::class => Factory\UpdaterFactory::class,
        ],
        'factories' => [
            Result\ResultFactory::class => Result\ResultFactoryFactory::class,
            Manager\UpdaterManager::class => Manager\UpdaterManagerFactory::class,
            Factory\UpdaterFactory::class => Factory\UpdaterFactoryFactory::class,
        ],
    ],
];
