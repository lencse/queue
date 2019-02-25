<?php

namespace Lencse\Queue\DependencyInjection;

interface Container
{
    public function alias(string $abstract, string $concrete): void;

    public function setup(string $class, array $params): void;

    public function factory(string $class, callable $factory): void;

    public function get(string $id): object;
}
