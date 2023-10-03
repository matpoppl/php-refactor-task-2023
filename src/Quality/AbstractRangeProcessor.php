<?php

namespace App\Quality;

use App\Item;

abstract class AbstractRangeProcessor
{
    protected ?int $min = null;
    protected ?int $max = null;
    protected ActionType $action;
    protected int $value;
    
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
        $value = $options['value'] ?? null;
        $action = $options['action'] ?? null;
        
        switch ($action) {
            case ActionType::INCREMENT:
            case ActionType::DECREMENT:
            case ActionType::SET:
                $this->action = $action;
                break;
            default:
                throw new \UnexpectedValueException("Unsuported action type `{$action}`");
        }
        
        if (null === $value) {
            throw new \UnexpectedValueException("Value option required");
        }
        
        $this->value = $value;
    }
}
