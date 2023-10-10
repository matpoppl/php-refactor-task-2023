<?php

namespace App\Updater\Result;

interface ResultFactoryInterface
{
    public function createResult(int $sell_in, int $quality): ResultInterface;
}
