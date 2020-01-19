<?php

namespace App\Exceptions\Contracts;

interface ValidationResult
{
    public function reason(): string;

    public function data(): array;
}
