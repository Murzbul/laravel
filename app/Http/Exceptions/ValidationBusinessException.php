<?php

namespace App\Http\Exceptions;

use App\Exceptions\Contracts\ValidationResult;
use App\Exceptions\Validation\ResultBag;
use Flugg\Responder\Exceptions\Http\HttpException;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class ValidationBusinessException extends HttpException
{
    protected $status = Response::HTTP_BAD_REQUEST;
    protected $errorCode = 'process_error';

    public function __construct(ResultBag $resultBag)
    {
        parent::__construct(trans('errors.unhandled'));
        $this->data = $this->transform($resultBag);
    }

    private function transform(ResultBag $resultBag)
    {
        return ['errors' => $this->extract($resultBag->getErrors())];
    }

    /**
     * @param ValidationResult[] | Collection $results
     */
    private function extract(Collection $results): array
    {
        return $results
            ->map(function (ValidationResult $result) {
                return $result->reason();
            })
            ->toArray();
    }
}
