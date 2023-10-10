<?php

namespace App\Updater\Result;

interface ResultInterface
{
    public function getSellIn(): int;
    public function getQuality(): int;
}
