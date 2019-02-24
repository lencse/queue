<?php

namespace Test\Unit\Web;

use Lencse\Queue\Application\Invoker;
use Lencse\Queue\Web\Application\WebApplication;
use Lencse\Queue\Web\Http\HttpMethod;
use Lencse\Queue\Web\Http\Request;
use Lencse\Queue\Web\Http\RequestSource;
use Lencse\Queue\Web\Http\JsonResponse;
use Lencse\Queue\Web\Http\ResponseRenderer;
use Lencse\Queue\Web\Routing\Handler;
use Lencse\Queue\Web\Routing\Path;
use Lencse\Queue\Web\Routing\Route;
use Lencse\Queue\Web\Routing\Router;
use PHPUnit\Framework\TestCase;

class WebTest extends TestCase
{
    public function testRunApplication(): void
    {
        $requestSource = new class implements RequestSource
        {
            public function create(): Request
            {
                return new Request('/', 'GET');
            }
        };
        $router = new Router([
            new Route(HttpMethod::get(), new Path('/'), new Handler('Action', 'Encoder')),
        ]);
        $invoker = new class implements Invoker
        {
            public function invoke(string $class, ...$params)
            {
                if ('Action' === $class) {
                    return 1;
                }
                if ('Encoder' === $class) {
                    return sprintf('/%d/', $params[0]);
                }
                return '';
            }
        };
        $responseRenderer = new class implements ResponseRenderer
        {
            /**
             * @var JsonResponse
             */
            public $response;

            public function render(JsonResponse $response): void
            {
                $this->response = $response;
            }
        };
        $app = new WebApplication(
            $requestSource,
            $router,
            $invoker,
            $responseRenderer
        );
        $app->run();
        /** @var JsonResponse $response */
        $response = $responseRenderer->response;
        $this->assertEquals('/1/', $response->content());
        $this->assertEquals([
            'HTTP/1.1 200 OK',
            'Content-Type: application/json; charset=utf-8',
        ], $response->headers());
    }
}
