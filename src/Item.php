<?php

namespace App;

final class Item
{
    public function __construct(public string $name, public int $sellIn, public int $quality)
    {
    }

    public function __toString()
    {
        return "{$this->name}, {$this->sellIn}, {$this->quality}";
    }
}
