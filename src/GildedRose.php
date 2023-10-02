<?php
namespace App;

use App\Quality\ActionType;
use App\Quality\SellInRangeProcessor;
use App\Quality\QualityTresholdProcessor;
use App\Quality\DoNothingProcessor;
use App\Quality\ProcessorInterface;

final class GildedRose
{

    /**
     * ProcessorInterface[][]
     */
    private $itemProcessors = [];

    public function __construct()
    {
        // @TODO create processors configuration
        $this->setDefaultItemProcessors([
            new SellInRangeProcessor([
                'max' => 0,
                'action' => ActionType::DECREMENT,
                'value' => 2
            ]),
            new SellInRangeProcessor([
                'min' => 1,
                'action' => ActionType::DECREMENT,
                'value' => 1
            ]),
            new QualityTresholdProcessor([
                'max' => 0,
                'action' => ActionType::SET,
                'value' => 0
            ])
        ]);

        $this->setItemProcessorsFor('Sulfuras, Hand of Ragnaros', [
            new DoNothingProcessor()
        ]);

        $this->setItemProcessorsFor('Aged Brie', [
            new SellInRangeProcessor([
                'max' => 0,
                'action' => ActionType::INCREMENT,
                'value' => 2
            ]),
            new SellInRangeProcessor([
                'min' => 1,
                'action' => ActionType::INCREMENT,
                'value' => 1
            ]),
            new QualityTresholdProcessor([
                'min' => 50,
                'action' => ActionType::SET,
                'value' => 50
            ])
        ]);

        $this->setItemProcessorsFor('Backstage passes to a TAFKAL80ETC concert', [
            new SellInRangeProcessor([
                'max' => 0,
                'action' => ActionType::SET,
                'value' => 0
            ]),
            new SellInRangeProcessor([
                'min' => 1,
                'max' => 5,
                'action' => ActionType::INCREMENT,
                'value' => 3
            ]),
            new SellInRangeProcessor([
                'min' => 6,
                'max' => 10,
                'action' => ActionType::INCREMENT,
                'value' => 2
            ]),
            new SellInRangeProcessor([
                'min' => 11,
                'action' => ActionType::INCREMENT,
                'value' => 1
            ]),
            new QualityTresholdProcessor([
                'min' => 50,
                'action' => ActionType::SET,
                'value' => 50
            ])
        ]);
    }

    public function hasItemProcessorsFor(string $name): bool
    {
        return array_key_exists($name, $this->itemProcessors);
    }

    /**
     *
     * @param string $name
     * @return ProcessorInterface[]
     */
    public function getItemProcessorsFor(string $name): array
    {
        if (! array_key_exists($name, $this->itemProcessors)) {
            throw new \DomainException("Processor for name `{$name}` dont exists");
        }

        return $this->itemProcessors[$name];
    }

    public function setItemProcessorsFor(string $name, array $processors)
    {
        $this->itemProcessors[$name] = [];
        foreach ($processors as $processor) {
            $this->addItemProcessorFor($name, $processor);
        }
    }

    /**
     *
     * @return ProcessorInterface[]
     */
    public function getDefaultItemProcessors(): array
    {
        return $this->getItemProcessorsFor('__default');
    }

    public function setDefaultItemProcessors(array $processors)
    {
        $this->setItemProcessorsFor('__default', $processors);
    }

    public function addItemProcessorFor(string $name, ProcessorInterface $processor)
    {
        $this->itemProcessors[$name][] = $processor;
    }

    public function updateQuality(Item $item): void
    {
        $name = $item->name;
        $processors = $this->hasItemProcessorsFor($name) ? $this->getItemProcessorsFor($name) : $this->getDefaultItemProcessors();

        $willDecreaseSellIn = false;
        foreach ($processors as $processor) {
            if ($processor->supports($item)) {
                $willDecreaseSellIn = true;
                $processor->process($item);
            }
        }

        if ($willDecreaseSellIn) {
            $item->sell_in = $item->sell_in - 1;
        }
    }
}