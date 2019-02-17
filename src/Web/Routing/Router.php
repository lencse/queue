<?php

namespace Lencse\Queue\Web\Routing;

use Lencse\Queue\Web\Http\Request;
use Lencse\Queue\Web\Routing\Exception\NotFound;

final class Router
{
    /**
     * @var Route[]
     */
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function route(Request $request): RoutingResult
    {
        foreach ($this->routes as $route) {
            if ($route->path()->match($request->uri()) || $route->method()->match($request->method())) {
                return new RoutingResult($route->handler());
            }
        }

        throw new NotFound($request->uri());
    }
}
