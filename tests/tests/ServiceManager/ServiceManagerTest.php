<?php

namespace App\ServiceManager;

use App\ServiceManager\Factory\InvokableFactory;
use PHPUnit\Framework\TestCase;
use ArrayObject;

class ServiceManagerTest extends TestCase
{
    public function testHasGet()
    {
        $expected = ['one', 'two'];
        
        $sm = new ServiceManager([
            'aliases' => [
                'foo' => 'bar',
                'bar' => 'baz',
            ],
            'services' => [
                'baz' => $expected,
            ],
        ]);
        
        self::assertTrue($sm->has('foo'));
        self::assertTrue($sm->has('bar'));
        self::assertTrue($sm->has('baz'));
        
        self::assertEquals($expected, $sm->get('foo'));
        self::assertEquals($expected, $sm->get('bar'));
        self::assertEquals($expected, $sm->get('baz'));
    }
    
    public function testGetService()
    {
        $sm = new ServiceManager([
            'aliases' => [
                'foo' => 'bar',
                'bar' => ArrayObject::class,
            ],
            'factories' => [
                ArrayObject::class => InvokableFactory::class,
            ],
        ]);
        
        self::assertInstanceOf(ArrayObject::class, $sm->get(ArrayObject::class));
        self::assertInstanceOf(ArrayObject::class, $sm->get('bar'));
        self::assertInstanceOf(ArrayObject::class, $sm->get('foo'));
    }
    
    public function testCreateService()
    {
        $expected = ['one', 'two'];
        
        $sm = new ServiceManager([
            'aliases' => [
                'foo' => 'bar',
                'bar' => ArrayObject::class,
            ],
            'factories' => [
                ArrayObject::class => InvokableFactory::class,
            ],
        ]);
        
        $service = $sm->create(ArrayObject::class, $expected);
        
        self::assertInstanceOf(ArrayObject::class, $service);
        self::assertEquals($expected, $service->getArrayCopy());
    }
    
    public function testSet()
    {
        $key = 'foo';
        $expected = ['one', 'two'];
        
        $sm = new ServiceManager([]);
        
        self::assertFalse($sm->has($key));
        
        $sm->setService($key, $expected);
        
        self::assertTrue($sm->has($key));
        self::assertEquals($expected, $sm->get($key));
    }
    
    public function testMissingService()
    {
        $missingServiceName = 'Foobarbazqux';
        
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Service `{$missingServiceName}` not found");
        
        $sm = new ServiceManager([]);
        
        $sm->get($missingServiceName);
    }
}
