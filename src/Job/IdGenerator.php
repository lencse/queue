<?php

namespace Lencse\Queue\Job;

interface IdGenerator
{
    public function generate(): int;
}
