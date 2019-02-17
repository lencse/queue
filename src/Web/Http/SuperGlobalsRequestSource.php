<?php

namespace Lencse\Queue\Web\Http;

final class SuperGlobalsRequestSource implements RequestSource
{
    /**
     * @var array
     */
    private $serverArr;

    public function __construct(array $serverArr)
    {
        $this->serverArr = $serverArr;
    }

    public function create(): Request
    {
        return new Request(
            (string) $this->serverArr['REQUEST_URI'],
            (string) $this->serverArr['REQUEST_METHOD']
        );
    }
}
