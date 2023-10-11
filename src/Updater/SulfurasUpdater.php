<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

class SulfurasUpdater extends AbstractUpdater
{
    public function update(int $sellIn, int $quality): ResultInterface
    {
        return $this->resultFactory->createResult($sellIn, $quality);
    }
}
