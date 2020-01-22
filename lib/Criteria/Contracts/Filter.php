<?php

namespace Lib\Criteria\Contracts;

interface Filter
{
    public function values();

    public function get(string $key, $default = null);

    public function getRaw(string $key, $default = null);

    public function getArray(string $key);

    public function has(string $key);

    public function isNotEmpty(string $key);

    public function getFields();
}
