<?php

namespace Http\Support\Bag;

class Bag
{
    protected array $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * Returns the parameters
     * @param string|null $key
     *  @return mixed|null
     */
    public function all(string $key = null): mixed
    {
        if (!is_null($key))
        {
            return $this->get($key);
        }
        return $this->parameters;
    }

    /**
     * Returns element from parameters
     * @param string $key
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return array_key_exists($key,$this->parameters) ? $this->parameters[$key] : $default;
    }

    /**
     * Returns the parameter keys.
     * @return array
     */
    public function keys(): array
    {
        return array_keys($this->parameters);
    }

    /**
     * Returns true if the parameter is defined.
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key,$this->parameters);
    }

    /**
     * Returns count elements in parameters
     * @return int
     */
    public function count(): int
    {
        return count($this->parameters);
    }

    /**
     * Returns true if the parameters is empty
     * @return bool
     */
    public function empty():bool
    {
        return empty($this->parameters);
    }

    /**
     * Add element in parameters
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set(string $key, mixed $value):static
    {
        $this->parameters[$key] = $value;
        return $this;
    }

    /**
     * Add multi element to the parameters
     * @param array $parameters
     * @return $this
     */
    public function add(array $parameters = []):static
    {
        $this->parameters = array_replace($this->parameters,$parameters);
        return $this;
    }

    /**
     * Replace all parameters
     * @param array $parameters
     * @return array
     */
    public function replace(array $parameters = []): array
    {
        return $this->parameters = $parameters;
    }

    /**
     * Remove element from the parameters
     * @param string $key
     * @return bool
     */
    public function remove(string $key): bool
    {
        if (!$this->has($key))
        {
            return false;
        }
        unset($this->parameters[$key]);
        return true;
    }

    /**
     * Remove all parameters
     * @return bool
     */
    public function removeAll(): bool
    {
        array_splice($this->parameters,0);
        return true;
    }
}