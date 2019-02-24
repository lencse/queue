<?php

namespace Lencse\Queue\Logging;

interface Logger
{
    public function log(string $msg): void;
}
