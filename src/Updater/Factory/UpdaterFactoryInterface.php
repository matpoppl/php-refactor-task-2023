<?php

namespace App\Updater\Factory;

use App\Updater\UpdaterInterface;

interface UpdaterFactoryInterface
{
    public function createUpdater(string $name): UpdaterInterface;
}
