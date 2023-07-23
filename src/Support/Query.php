<?php

namespace Http\Support;

use Http\Support\Abstract\AbstractHttp;

class Query extends AbstractHttp
{
    public function all(string $key =null):mixed
    {
        if (!is_null($key))
        {
            return $this->get($key);
        }
        return $this->parameters;
    }

    public function get(string $key,mixed $default = null)
    {
        return array_key_exists($key,$this->parameters) ? $this->parameters[$key]: $default;
    }

    public function keys(): array
    {
        return array_keys($this->parameters);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key,$this->parameters);
    }

    public function count(): int
    {
        return count($this->parameters);
    }

    public function set(string $key,mixed $value):static
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    public function add(array $parameters = []):static
    {
        $this->parameters = array_replace($this->parameters,$parameters);
        return $this;
    }

    public function replace(array $parameters = []): array
    {
        return $this->parameters = $parameters;
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