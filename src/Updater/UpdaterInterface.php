<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

interface UpdaterInterface
{
    public function update(int $sellIn, int $quality): ResultInterface;
}
