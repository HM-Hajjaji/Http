<?php

namespace Http\Support\Abstract;

abstract class AbstractHttp
{
    protected array $parameters;

    /**
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }
}