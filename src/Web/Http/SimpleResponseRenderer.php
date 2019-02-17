<?php

namespace Lencse\Queue\Web\Http;

class SimpleResponseRenderer implements ResponseRenderer
{
    public function render(Response $response): void
    {
        echo $response->content();
    }
}
