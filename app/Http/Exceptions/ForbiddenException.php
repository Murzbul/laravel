<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class ForbiddenException extends HttpException
{
    protected $status = Response::HTTP_FORBIDDEN;
    protected $errorCode = 'forbidden';
}
