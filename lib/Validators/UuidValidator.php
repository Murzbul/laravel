<?php

namespace Lib\Validators;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class UuidValidator
{
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @throws ValidationException
     */
    public function validate(string $uuid): array
    {
        $validator = new Validator($this->translator, ['uuid' => $uuid], ['uuid' => 'uuid']);

        return $validator->validate();
    }
}
