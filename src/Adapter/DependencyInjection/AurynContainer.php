<?php

namespace Lencse\Queue\Adapter\DependencyInjection;

use Auryn\Injector;
use Lencse\Queue\Application\Invoker;
use Lencse\Queue\DependencyInjection\Container;

final class AurynContainer implements Container, Invoker
{
    /**
     * @var Injector
     */
    private $auryn;

    /**
     * @var bool[]
     */
    private $instances = [];

    public function __construct()
    {
        $this->auryn = new Injector();
        $this->auryn->alias(Invoker::class, self::class);
        $this->auryn->share($this);
    }

    public function invoke(string $class, ...$params)
    {
        /** @var callable $callable */
        $callable = $this->get($class);

        return $callable(...$params);
    }

    public function alias(string $abstract, string $concrete): void
    {
        $this->auryn->alias($abstract, $concrete);
    }

    public function setup(string $class, array $params): void
    {
        $defineParams = [];
        foreach ($params as $name => $param) {
            $defineParams[":$name"] = $param;
        }
        $this->auryn->define($class, $defineParams);
    }

    public function get(string $class): object
    {
        if (isset($this->instances[$class])) {
            return $this->makeInstance($class);
        }
        $instance = $this->makeInstance($class);
        $this->auryn->share($instance);
        $this->instances[$class] = true;

        return $this->makeInstance($class);
    }

    private function makeInstance(string $class): object
    {
        return $this->auryn->make($class);
    }
}
