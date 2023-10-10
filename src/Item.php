<?php

namespace App;

final class Item
{
    public function __construct(public string $name, public int $sell_in, public int $quality)
    {
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}
