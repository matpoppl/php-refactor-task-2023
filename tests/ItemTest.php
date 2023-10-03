<?php

use App\GildedRose;
use App\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testConstructor(): void
    {
        $item = new Item('foo', 123, 456);
        
        $this->assertEquals('foo', $item->name);
        $this->assertEquals(123, $item->sell_in);
        $this->assertEquals(456, $item->quality);
        
        $this->assertEquals('foo, 123, 456', '' . $item);
    }
}
