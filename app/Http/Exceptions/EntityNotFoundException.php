<?php

namespace App\Http\Exceptions;

use Doctrine\ORM\EntityNotFoundException as DoctrineEntityNotFoundException;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;

class EntityNotFoundException extends HttpException
{
    protected $status = Response::HTTP_BAD_REQUEST;
    protected $errorCode = 'entity_not_found';

    public function __construct(DoctrineEntityNotFoundException $notFoundException)
    {
        parent::__construct(trans("errors.{$notFoundException->getMessage()}.not_found"));
    }
}
