<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class AuthException extends HttpException
{
    protected $status = Response::HTTP_UNPROCESSABLE_ENTITY;
    protected $errorCode = 'unprocessable entity';

    public function __construct(string $message = null, array $headers = null)
    {
        parent::__construct($message, $headers);
        $this->data = ['errors' => [$this->message]];
    }
}
