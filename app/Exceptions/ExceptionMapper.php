<?php

namespace App\Exceptions;

use App\Exceptions\Validation\ResultBag;
use App\Exceptions\Validation\ValidationResult;
use App\Http\Exceptions\AuthException;
use App\Http\Exceptions\EntityNotFoundException;
use App\Http\Exceptions\PageNotFoundException;
use App\Http\Exceptions\UniqueViolationException;
use App\Http\Exceptions\UnknownException;
use App\Http\Exceptions\ValidationBusinessException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityNotFoundException as DoctrineEntityNotFoundException;
use Exception;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionMapper
{
    /** @var Collection */
    private $converts;

    public function __construct()
    {
        $this->converts = new Collection();

        $this->registerConversion(NotFoundHttpException::class, function (NotFoundHttpException $exception) {
            return new PageNotFoundException();
        });

        $this->registerConversion(AuthenticationException::class, function (AuthenticationException $exception) {
            return new AuthException($exception->getMessage());
        });

        /*
        *
        * Laravel validation levels.
        *
        */
        $this->registerConversion(ValidationException::class, function (ValidationException $exception) {
            $resultBag = new ResultBag();
            foreach ($exception->errors() as $errors) {
                foreach ($errors as $error) {
                    $resultBag->addError(new ValidationResult($error));
                }
            }

            return new ValidationBusinessException($resultBag);
        });

        /*
         *
         * Doctrine errors.
         *
         */
        $this->registerConversion(DoctrineEntityNotFoundException::class, function (DoctrineEntityNotFoundException $exception) {
            $resultBag = new ResultBag();
            $resultBag->addError(new ValidationResult((new EntityNotFoundException($exception))->getMessage()));

            return new ValidationBusinessException($resultBag);
        });

        $this->registerConversion(UniqueConstraintViolationException::class, function (UniqueConstraintViolationException $exception) {
            return new UniqueViolationException(trans('errors.unique_entity'));
        });
    }

    /**
     * @param string $default Exception class name to convert
     * @param string | callable $target the class name to convert to, or callable which should receive the $default param
     *
     * @return $this
     */
    public function registerConversion(string $default, $target)
    {
        $this->converts->put($default, $target);

        return $this;
    }

    public function removeConversion(string $default)
    {
        $this->converts->forget($default);

        return $this;
    }

    public function convert(Exception $exception): HttpException
    {
        foreach ($this->converts as $from => $to) {
            if ($exception instanceof $from) {
                if (is_callable($to)) {
                    return $to($exception);
                }

                return new $to;
            }
        }

        return new UnknownException($exception);
    }
}
