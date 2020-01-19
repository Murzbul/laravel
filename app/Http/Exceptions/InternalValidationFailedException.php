<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class InternalValidationFailedException extends HttpException
{
    protected $status = Response::HTTP_BAD_REQUEST;
    protected $errorCode = 'bad_data_request';

    public function __construct(\Exception $exception)
    {
        parent::__construct($exception->getMessage());
    }
}
