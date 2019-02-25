<?php

namespace Lencse\Queue\Id;

interface IdGenerator
{
    public function generate(): int;
}
