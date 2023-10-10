<?php

namespace App\Updater\Result;

class ResultFactory implements ResultFactoryInterface
{
    public function createResult(int $sell_in, int $quality): ResultInterface
    {
        return new Result($sell_in, $quality);
    }
}
