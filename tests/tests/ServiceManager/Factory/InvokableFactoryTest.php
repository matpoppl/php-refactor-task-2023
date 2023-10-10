<?php

namespace App\ServiceManager\Factory;

use Psr\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use ArrayObject;

class InvokableFactoryTest extends TestCase
{
    public function testCreate()
    {
        $factory = new InvokableFactory();
        
        $container = $this->getMockBuilder(ContainerInterface::class)->getMock();
        
        $service = $factory($container, ArrayObject::class, ['foo', 'bar', 'baz']);
        
        self::assertInstanceOf(ArrayObject::class,  $service);
        
        self::assertEquals(3, count($service));
        self::assertEquals('foo', $service[0]);
        self::assertEquals('bar', $service[1]);
        self::assertEquals('baz', $service[2]);
    }
    
    public function testClassDontExists()
    {
        $missingClassName = 'Foobarbazqux';
        
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Service class `{$missingClassName}` dont exists");
        
        $factory = new InvokableFactory();
        
        $container = $this->getMockBuilder(ContainerInterface::class)->getMock();
        
        $factory($container, $missingClassName);
    }
}
