<?php

namespace Test\Unit\DependencyInjection;

use Lencse\Queue\DependencyInjection\Adapter\AurynContainer;
use PHPUnit\Framework\TestCase;

class AurynContainerTest extends TestCase implements TestInterface
{
    public function testGet(): void
    {
        $container = new AurynContainer();
        $this->assertInstanceOf(self::class, $container->get(self::class));
    }

    public function testGetReturnsSameInstance(): void
    {
        $container = new AurynContainer();
        /** @var ClassWithoutConstructorParam $obj1 */
        $obj1 = $container->get(ClassWithoutConstructorParam::class);
        $this->assertEquals(0, $obj1->value);
        $obj1->value = 1;
        /** @var ClassWithoutConstructorParam $obj2 */
        $obj2 = $container->get(ClassWithoutConstructorParam::class);
        $this->assertEquals(1, $obj1->value);
    }

    public function testAlias(): void
    {
        $container = new AurynContainer();
        $container->alias(TestInterface::class, self::class);
        $this->assertInstanceOf(self::class, $container->get(TestInterface::class));
    }

    public function testSetup(): void
    {
        $container = new AurynContainer();
        $container->setup(ClassWithConstructorParam::class, ['value' => 1]);
        $this->assertEquals(1, $container->get(ClassWithConstructorParam::class)->value);
    }

    public function testInvoke(): void
    {
        $container = new AurynContainer();
        $this->assertEquals(1, $container->invoke(CallableClass::class, 1));
    }
}
