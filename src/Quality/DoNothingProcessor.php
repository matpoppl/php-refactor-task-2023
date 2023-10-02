<?php

namespace App\Quality;

use App\Item;

class DoNothingProcessor implements ProcessorInterface
{
    public function supports(Item $item) : bool
    {
        return false;
    }
    
    public function process(Item $item) : void
    {}
}
