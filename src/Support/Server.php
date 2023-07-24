<?php

namespace Http\Support;

use Http\Support\Bag\Bag;

class Server extends Bag
{
    public function getMethod():string
    {
        return strtoupper($this->parameters['REQUEST_METHOD']);
    }

    public function setMethod(string $method = "GET"|"POST"): string
    {
        return $this->parameters['REQUEST_METHOD'] = strtoupper($method);
    }

    public function getPathInfo():string
    {
        return $this->parameters['PATH_INFO']??"/";
    }

    public function getRequestUri()
    {
        return $this->parameters['REQUEST_URI'];
    }

    public function getReferer():string
    {
        return$this->parameters["HTTP_REFERER"]??$this->getPathInfo();
    }

    public function getBaseUri():string
    {
        return sprintf("%s://%s/",$this->getProtocol(),$this->getHttpHost());
    }

    public function getHttpHost():string
    {
        return $this->parameters['HTTP_HOST'];
    }

    public function getProtocol():string
    {
        $protocol = "http";
        if (isset($this->parameters['HTTPS']) && $this->parameters['HTTPS'] === 'on') {
            $protocol = "https";
        }
        return $protocol;
    }
}