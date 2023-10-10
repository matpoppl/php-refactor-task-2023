<?php

namespace App\Updater\Factory;

use App\Updater\AgedBrieUpdater;
use App\Updater\BackstageTAFKAL80ETCUpdater;
use App\Updater\StandardUpdater;
use App\Updater\SulfurasUpdater;
use App\Updater\Result\ResultFactoryInterface;
use PHPUnit\Framework\TestCase;

class UpdaterFactoryTest extends TestCase
{
    /**
     * @dataProvider itemsProvider
     * @param string $name
     * @param string $expected
     */
    public function testCreateUpdater(string $name, string $expected)
    {
        $resultFactory = $this->getMockBuilder(ResultFactoryInterface::class)->getMock();
        $factory = new UpdaterFactory($resultFactory);
        self::assertInstanceOf($expected, $factory->createUpdater($name));
    }
    
    public function itemsProvider(): array
    {
        return [
            ['Sulfuras, Hand of Ragnaros', SulfurasUpdater::class],
            ['Aged Brie', AgedBrieUpdater::class],
            ['Backstage passes to a TAFKAL80ETC concert', BackstageTAFKAL80ETCUpdater::class],
            ['foo', StandardUpdater::class],
            ['bar', StandardUpdater::class],
            ['baz', StandardUpdater::class],
        ];
    }
}
