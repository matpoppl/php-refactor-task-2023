<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

class StandardUpdater extends AbstractUpdater
{
    public function update(int $sell_in, int $quality): ResultInterface
    {
        if ($sell_in < 1) {
            $quality -= 2;
        } else {
            $quality -= 1;
        }

        if ($quality < 1) {
            $quality = 0;
        }

        $sell_in--;

        return $this->resultFactory->createResult($sell_in, $quality);
    }
}
