<?php

namespace App\Updater\Manager;

use App\Item;
use App\Updater\Factory\UpdaterFactoryInterface;

class UpdaterManager implements UpdaterManagerInterface
{
    public function __construct(private UpdaterFactoryInterface $updaterFactory)
    {
    }

    public function update(Item $item): void
    {
        $updater = $this->updaterFactory->createUpdater($item->name);
        $result = $updater->update($item->sellIn, $item->quality);

        $item->sellIn = $result->getSellIn();
        $item->quality = $result->getQuality();
    }
}
