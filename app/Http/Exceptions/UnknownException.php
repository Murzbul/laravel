<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class UnknownException extends HttpException
{
    protected $status = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $errorCode = 'internal_error';
    private $exception;

    public function __construct(\Exception $exception)
    {
        parent::__construct(trans('errors.unhandled'));
        $this->exception = $exception;
    }
}
