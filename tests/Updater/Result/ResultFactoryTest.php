<?php

namespace App\Updater\Result;

use PHPUnit\Framework\TestCase;

class ResultFactoryTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     * @param string $name
     * @param string $expected
     */
    public function testCreateUpdater(int $sellIn, int $quality)
    {
        $factory = new ResultFactory();
        $result = $factory->createResult($sellIn, $quality);
        
        self::assertInstanceOf(ResultInterface::class, $result);
        self::assertEquals($sellIn, $result->getSellIn());
        self::assertEquals($quality, $result->getQuality());
    }
    
    public function itemsProvider(): array
    {
        return [
            [1,2],
            [33,44],
        ];
    }
}
