<?php

namespace App\Updater\Result;

class Result implements ResultInterface
{
    public function __construct(private int $sell_in, private int $quality)
    {
    }

    public function getSellIn(): int
    {
        return $this->sell_in;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }
}
