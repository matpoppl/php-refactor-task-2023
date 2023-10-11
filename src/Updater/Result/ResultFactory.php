<?php

namespace App\Updater\Result;

class ResultFactory implements ResultFactoryInterface
{
    public function createResult(int $sellIn, int $quality): ResultInterface
    {
        return new Result($sellIn, $quality);
    }
}
