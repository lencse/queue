<?php

namespace Test\Unit\Web;

use Lencse\Queue\Web\Application\WebApplication;
use PHPUnit\Framework\TestCase;

class WebTest extends TestCase
{
    public function testRunApplication(): void
    {
        $app = new WebApplication();
        $app->run();
        $this->assertNotNull($app);
    }
}
