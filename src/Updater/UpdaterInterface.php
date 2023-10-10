<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

interface UpdaterInterface
{
    public function update(int $sell_in, int $quality): ResultInterface;
}
