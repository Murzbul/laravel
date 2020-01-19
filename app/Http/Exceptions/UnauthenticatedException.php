<?php

namespace App\Http\Exceptions;

use Flugg\Responder\Exceptions\Http\UnauthenticatedException as BaseException;
use Illuminate\Http\Response;

class UnauthenticatedException extends BaseException
{
    protected $status = Response::HTTP_UNPROCESSABLE_ENTITY;

    public function __construct()
    {
        parent::__construct(trans('auth.failed'));
        $this->errorCode = 'bad_credentials';
    }
}
