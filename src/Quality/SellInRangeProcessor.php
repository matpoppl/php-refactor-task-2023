<?php

namespace App\Quality;

use App\Item;

class SellInRangeProcessor implements ProcessorInterface
{
    private ?int $min = null;
    private ?int $max = null;
    private ActionType $action;
    private int $value;
    
    /**
     * 
     * @param array $options
     * 
     * @throws \UnexpectedValueException
     */
    public function __construct(array $options)
    {
        $this->min = $options['min'] ?? null;
        $this->max = $options['max'] ?? null;
        $this->value = $options['value'] ?? null;
        
        $action = $options['action'] ?? null;
        
        switch ($action) {
            case ActionType::INCREMENT:
            case ActionType::DECREMENT:
            case ActionType::SET:
                $this->action = $action;
                // ok
                break;
            default:
                throw new \UnexpectedValueException("Unsuported action type `{$this->action}`");
        }
        
        if (null === $this->value) {
            throw new \UnexpectedValueException("Value option required");
        }
    }
    
    public function supports(Item $item) : bool
    {
        // is below min
        if (null !== $this->min && $this->min > $item->sell_in) {
            // skip
            return false;
        }
        
        // is above max
        if (null !== $this->max && $this->max < $item->sell_in) {
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
