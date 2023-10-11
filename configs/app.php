<?php

use App\Updater\Factory;
use App\Updater\Manager;
use App\Updater\Result;
use App\Updater;

return [
    Factory\UpdaterFactoryFactory::SERVICE_CONFIG_KEY => [
        'default_updater' => Updater\StandardUpdater::class,
        'aliases' => [
            'Sulfuras, Hand of Ragnaros' => Updater\SulfurasUpdater::class,
            'Aged Brie' => Updater\AgedBrieUpdater::class,
            'Backstage passes to a TAFKAL80ETC concert' => Updater\BackstageTAFKAL80ETCUpdater::class,
        ],
    ],
    
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
