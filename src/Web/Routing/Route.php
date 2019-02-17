<?php

namespace Lencse\Queue\Web\Routing;

use Lencse\Queue\Web\Http\HttpMethod;

final class Route
{
    /**
     * @var HttpMethod
     */
    private $method;

    /**
     * @var Path
     */
    private $path;

    /**
     * @var Handler
     */
    private $handler;

    public function __construct(HttpMethod $method, Path $path, Handler $handler)
    {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
    }

    public function method(): HttpMethod
    {
        return $this->method;
    }

    public function path(): Path
    {
        return $this->path;
    }

    public function handler(): Handler
    {
        return $this->handler;
    }
}
