<?php

namespace Lencse\Queue\Web\Http;

interface ResponseRenderer
{
    public function render(Response $response): void;
}
