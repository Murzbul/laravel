<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class UniqueViolationException extends HttpException
{
    protected $status = Response::HTTP_BAD_REQUEST;
    protected $errorCode = 'unique_entity_violation';

    public function __construct(string $message = null, array $headers = null)
    {
        parent::__construct($message, $headers);
        $this->data = ['errors' => [$this->message]];
    }
}
