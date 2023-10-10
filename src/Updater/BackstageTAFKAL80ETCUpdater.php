<?php

namespace App\Updater;

use App\Updater\Result\ResultInterface;

class BackstageTAFKAL80ETCUpdater extends AbstractUpdater
{
    public function update(int $sell_in, int $quality): ResultInterface
    {
        if ($sell_in < 1) {
            $quality = 0;
        } elseif ($sell_in > 0 && $sell_in < 6) {
            $quality += 3;
        } elseif ($sell_in > 5 && $sell_in < 11) {
            $quality += 2;
        } else {
            $quality += 1;
        }

        if ($quality > 50) {
            $quality = 50;
        }

        $sell_in--;

        return $this->resultFactory->createResult($sell_in, $quality);
    }
}
