<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;

class PageNotFoundException extends HttpException
{
    protected $status = 404;
    protected $errorCode = 'page_not_found';

    public function __construct(string $message = null, array $headers = null)
    {
        parent::__construct($message, $headers);
        $this->data = ['errors' => [$this->errorCode]];
    }
}
