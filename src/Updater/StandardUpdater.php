<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

class StandardUpdater extends AbstractUpdater
{
    public function update(int $sellIn, int $quality): ResultInterface
    {
        if ($sellIn < 1) {
            $quality -= 2;
        } else {
            $quality -= 1;
        }

        if ($quality < 1) {
            $quality = 0;
        }

        $sellIn--;

        return $this->resultFactory->createResult($sellIn, $quality);
    }
}
