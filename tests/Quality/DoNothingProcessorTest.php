<?php

namespace App\Quality;

use App\Item;
use PHPUnit\Framework\TestCase;

class DoNothingProcessorTest extends TestCase
{
    public function testAll() 
    {
        $item = new Item('foo', 123, 456);
        
        $proc = new DoNothingProcessor();
        
        $this->assertTrue($proc instanceof ProcessorInterface);
        
        $this->assertFalse($proc->supports($item));
        
        $proc->process($item);
        
        $this->assertEquals('foo', $item->name);
        $this->assertEquals(123, $item->sell_in);
        $this->assertEquals(456, $item->quality);
    }
}
