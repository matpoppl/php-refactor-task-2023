<?php

namespace App;

use App\Updater\Manager\UpdaterManagerInterface;

class GildedRose
{
    public function __construct(private UpdaterManagerInterface $updaterManager)
    {
    }

    public function updateQuality(Item $item): void
    {
        $this->updaterManager->update($item);
    }
}
