<?php

namespace Lencse\Queue\Application;

interface Invoker
{
    public function invoke(string $class, array $params = []);
}
