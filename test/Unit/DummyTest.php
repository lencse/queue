<?php

namespace Test\Unit;

use Lencse\Queue\Dummy;
use PHPUnit\Framework\TestCase;

class DummyTest extends TestCase
{

    public function testDummy(): void
    {
        $d = new Dummy();
        $this->assertEquals(1, $d->val);
    }
}
