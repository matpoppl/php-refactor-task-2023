<?php

namespace App\Updater\Factory;

use App\Updater\AgedBrieUpdater;
use App\Updater\BackstageTAFKAL80ETCUpdater;
use App\Updater\StandardUpdater;
use App\Updater\SulfurasUpdater;
use App\Updater\UpdaterInterface;
use App\Updater\Result\ResultFactoryInterface;

class UpdaterFactory implements UpdaterFactoryInterface
{
    public function __construct(private ResultFactoryInterface $resultFactory)
    {
    }

    public function createUpdater(string $name): UpdaterInterface
    {
        return match ($name) {
            'Sulfuras, Hand of Ragnaros' => new SulfurasUpdater($this->resultFactory),
            'Aged Brie' => new AgedBrieUpdater($this->resultFactory),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstageTAFKAL80ETCUpdater($this->resultFactory),
            default => new StandardUpdater($this->resultFactory),
        };
    }
}
