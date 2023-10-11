<?php

namespace App\Updater\Result;

class Result implements ResultInterface
{
    public function __construct(private int $sellIn, private int $quality)
    {
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }
}
