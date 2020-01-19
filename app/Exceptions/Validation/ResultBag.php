<?php

namespace App\Exceptions\Validation;

use App\Exceptions\Contracts\ValidationResult;
use Illuminate\Support\Collection;

class ResultBag
{
    /** @var Collection */
    private $errors;
    /** @var Collection */
    private $warnings;
    /** @var Collection */
    private $messages;

    public function __construct()
    {
        $this->errors = new Collection();
        $this->warnings = new Collection();
        $this->messages = new Collection();
    }

    public function addError(ValidationResult $error): ResultBag
    {
        $this->errors->add($error);

        return $this;
    }

    public function addWarning(ValidationResult $warning): ResultBag
    {
        $this->warnings->add($warning);

        return $this;
    }

    public function addMessage(ValidationResult $message): ResultBag
    {
        $this->messages->add($message);

        return $this;
    }

    public function getErrors(): Collection
    {
        return $this->errors;
    }

    public function getWarnings(): Collection
    {
        return $this->warnings;
    }

    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function hasErrors(): bool
    {
        return $this->errors->isNotEmpty();
    }

    public function hasWarnings(): bool
    {
        return $this->warnings->isNotEmpty();
    }

    public function hastMessages(): bool
    {
        return $this->messages->isNotEmpty();
    }
}
