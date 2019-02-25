<?php

namespace Test\Unit\DependencyInjection;

class ClassWithConstructorParam
{
    /**
     * @var int
     */
    public $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }
}
