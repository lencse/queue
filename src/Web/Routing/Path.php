<?php

namespace Lencse\Queue\Web\Routing;

final class Path
{
    /**
     * @var string
     */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function match(string $path): bool
    {
        return $path === $this->path;
    }
}
