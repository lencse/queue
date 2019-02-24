<?php

namespace Lencse\Queue\Logging;

class ConsoleLogger implements Logger
{
    public function log(string $msg): void
    {
        echo $msg . PHP_EOL;
    }
}
