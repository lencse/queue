<?php

namespace Lencse\Queue\Web\Routing\Exception;

final class NotFound extends \RuntimeException
{
    public function __construct(string $path)
    {
        parent::__construct(sprintf('Invalid path: %s', $path));
    }
}
