<?php

namespace Lib\Criteria\Traits;

use Illuminate\Support\Arr;


// TODO: Change logic with collections

trait FilterTrait
{
    protected $values;

    public function __construct(array $data)
    {
        $keys = collect($this->filters)->values()->all();
        $this->values = Arr::only($data, $keys);
    }


    /**
     * Returns NULL if value is empty() === true.
     */
    public function get(string $key, $default = null)
    {
        $value = Arr::get($this->values, $key, $default);

        return $this->isEmpty($value) ? null : $value;
    }

    public function getRaw(string $key, $default = null)
    {
        return Arr::get($this->values, $key, $default);
    }

    /**
     * Returns an empty array as default.
     */
    public function getArray(string $key)
    {
        $value = $this->getRaw($key);

        return $this->isEmpty($value) ? [] : $value;
    }

    public function has(string $key)
    {
        return Arr::has($this->values, $key);
    }

    public function isNotEmpty(string $key)
    {
        return ! $this->isEmpty($this->getRaw($key));
    }

    public function values()
    {
        return $this->values;
    }

    private function isEmpty($value): bool {
        return $value === null || $value === false || $value === '' || $value === [];
    }
}
