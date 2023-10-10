<?php

namespace App\Updater\Manager;

use App\Item;

interface UpdaterManagerInterface
{
    public function update(Item $item): void;
}
