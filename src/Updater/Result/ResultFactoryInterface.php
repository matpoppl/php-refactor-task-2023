<?php

namespace App\Updater\Result;

interface ResultFactoryInterface
{
    public function createResult(int $sellIn, int $quality): ResultInterface;
}
