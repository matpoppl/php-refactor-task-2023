<?php

namespace App\Quality;

use App\Item;

interface ProcessorInterface
{
    public function supports(Item $item): bool;
    
    public function process(Item $item): void;
}
