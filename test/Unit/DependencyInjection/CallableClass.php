<?php

namespace Test\Unit\DependencyInjection;

class CallableClass
{
    public function __invoke(int $param): int
    {
        return $param;
    }
}
