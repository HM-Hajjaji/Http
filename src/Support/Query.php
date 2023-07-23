<?php

namespace Http\Support;

use Http\Support\Abstract\AbstractHttp;

class Query extends AbstractHttp
{
    public function get(string $key)
    {
        return $this->parameters[$key]??null;
    }

    public function all():array
    {
        return $this->parameters;
    }

    public function has(string $key): bool
    {
        return isset($this->parameters[$key]);
    }
    
    public function remove(string $key): bool
    {
        if (!$this->has($key))
        {
            return false;
        }
        unset($this->parameters[$key]);
        return true;
    }

    public function removeAll(): bool
    {
        array_splice($this->parameters,0);
        return true;
    }
}