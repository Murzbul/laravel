<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class UnauthorizedException extends HttpException
{
    protected $status = Response::HTTP_UNAUTHORIZED;
    protected $errorCode = 'unauthorized';
}
