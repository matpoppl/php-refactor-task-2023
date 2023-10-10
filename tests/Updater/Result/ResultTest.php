<?php

namespace App\Updater\Result;

use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     * @param string $name
     * @param string $expected
     */
    public function testCreateUpdater(int $sell_in, int $quality)
    {
        $result = new Result($sell_in, $quality);
        self::assertInstanceOf(ResultInterface::class, $result);
        self::assertEquals($sell_in, $result->getSellIn());
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