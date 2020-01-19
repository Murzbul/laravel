<?php

namespace App\Exceptions\Validation;

use App\Exceptions\Contracts\ValidationResult as Contract;

class ValidationResult implements Contract
{
    /** @var string */
    private $reason;
    /** @var array */
    private $data;

    public function __construct(string $reason, array $data = [])
    {
        $this->reason = $reason;
        $this->data = $data;
    }

    public function reason(): string
    {
        return $this->reason;
    }

    public function data(): array
    {
        return $this->data;
    }
}
