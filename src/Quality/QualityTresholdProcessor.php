<?php

namespace App\Quality;

use App\Item;

class QualityTresholdProcessor extends AbstractRangeProcessor implements ProcessorInterface
{
    public function supports(Item $item) : bool
    {
        // is below min
        if (null !== $this->min && $this->min > $item->quality) {
            // skip
            return false;
        }
        
        // is above max
        if (null !== $this->max && $this->max < $item->quality) {
            // skip
            return false;
        }
        
        return true;
    }
    
    public function process(Item $item) : void
    {
        switch ($this->action) {
            case ActionType::INCREMENT:
                $item->quality += $this->value;
                break;
            case ActionType::DECREMENT:
                $item->quality -= $this->value;
                break;
            case ActionType::SET:
                $item->quality = $this->value;
                break;
        }
    }
}
