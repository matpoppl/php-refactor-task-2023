<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

class SulfurasUpdater extends AbstractUpdater
{
    public function update(int $sell_in, int $quality): ResultInterface
    {
        return $this->resultFactory->createResult($sell_in, $quality);
    }
}
