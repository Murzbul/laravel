<?php

namespace App\Exceptions;

use App\Http\Exceptions\UnknownException;
use App\Http\Responders\Responder;
use Exception;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler;
use Illuminate\Http\JsonResponse;

class ExceptionHandler extends Handler
{
    private $responder;
    private $mapper;

    public function __construct(Responder $responder, ExceptionMapper $mapper, Container $container)
    {
        parent::__construct($container);
        $this->responder = $responder;
        $this->mapper = $mapper;
    }

    public function render($request, Exception $exception)
    {
        return $this->renderResponse(
            $this->mapper->convert($exception)
        );
    }

    public function report(Exception $exception)
    {
        if ($this->shouldReport($this->mapper->convert($exception))) {
            if (config('logging.sentry_enabled') && app()->bound('sentry')) {
                app('sentry')->captureException($exception);
            }
            parent::report($exception);
        }
    }

    public function shouldReport(Exception $exception)
    {
        return $exception instanceof UnknownException;
    }

    protected function renderResponse(HttpException $exception): JsonResponse
    {
        return $this->responder
            ->error($exception->errorCode(), $exception->message())
            ->data($exception->data())
            ->respond($exception->statusCode(), $exception->getHeaders());
    }
}
