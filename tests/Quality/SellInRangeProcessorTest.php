<?php

namespace App\Quality;

use App\Item;
use PHPUnit\Framework\TestCase;

class SellInRangeProcessorTest extends TestCase
{
    public function testWrongAction()
    {
        self::expectException(\UnexpectedValueException::class);
        self::expectExceptionMessage('Unsuported action type `--missing-action--`');
        
        new SellInRangeProcessor(['min' => 0, 'max' => 1, 'action' => '--missing-action--', 'value' => 0]);
    }
    
    public function testValueRequired()
    {
        self::expectException(\UnexpectedValueException::class);
        self::expectExceptionMessage('Value option required');
        
        new SellInRangeProcessor(['min' => 0, 'max' => 1, 'action' => ActionType::SET]);
    }
    
    /**
     * @dataProvider itemsProvider
     * @param string $name
     * @param int $sell_in
     * @param int $quality
     * @param bool $expectedSupports
     * @param int $expectedQuality
     * @param array $procOptions
     */
    public function testProcessing($name, $sell_in, $quality, $expectedSupports, $expectedQuality, $procOptions)
    {
        $item = new Item($name, $sell_in, $quality);
        
        $proc = new SellInRangeProcessor($procOptions);
        
        $supports = $proc->supports($item);
        
        $this->assertEquals($expectedSupports, $supports);
        
        if ($supports) {
            $proc->process($item);
            
            $this->assertEquals($expectedQuality, $item->quality);
        }
    }
    
    public function itemsProvider(): array
    {
        return [
            'Below range' => ['foo', 5, 1, false, 0, ['min' => 2, 'max' => 4, 'value' => 3, 'action' => ActionType::SET]],
            'Set 3'       => ['foo', 4, 2,  true, 3, ['min' => 2, 'max' => 4, 'value' => 3, 'action' => ActionType::SET]],
            'Add 3'       => ['foo', 3, 3,  true, 6, ['min' => 2, 'max' => 4, 'value' => 3, 'action' => ActionType::INCREMENT]],
            'Sub 3'       => ['foo', 2, 4,  true, 1, ['min' => 2, 'max' => 4, 'value' => 3, 'action' => ActionType::DECREMENT]],
            'Above range' => ['foo', 1, 5, false, 0, ['min' => 2, 'max' => 4, 'value' => 3, 'action' => ActionType::SET]],
        ];
    }
}
