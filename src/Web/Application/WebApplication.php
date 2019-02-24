<?php

namespace Lencse\Queue\Web\Application;

use Lencse\Queue\Application\Application;
use Lencse\Queue\Application\Invoker;
use Lencse\Queue\Web\Http\RequestSource;
use Lencse\Queue\Web\Http\JsonResponse;
use Lencse\Queue\Web\Http\ResponseRenderer;
use Lencse\Queue\Web\Routing\Router;

final class WebApplication implements Application
{
    /**
     * @var RequestSource
     */
    private $requestSource;

    /**
     * @var Router
     */
    private $router;

    /**
     * @var Invoker
     */
    private $invoker;

    /**
     * @var ResponseRenderer
     */
    private $responseRenderer;

    public function __construct(
        RequestSource $requestSource,
        Router $router,
        Invoker $invoker,
        ResponseRenderer $responseRenderer
    ) {
        $this->requestSource = $requestSource;
        $this->router = $router;
        $this->invoker = $invoker;
        $this->responseRenderer = $responseRenderer;
    }

    public function run(): void
    {
        $request = $this->requestSource->create();
        $routing = $this->router->route($request);
        $data = $this->invoker->invoke($routing->handler()->action());
        $encoded = $this->invoker->invoke($routing->handler()->encoder(), $data);
        $response = new JsonResponse($encoded);
        $this->responseRenderer->render($response);
    }
}
