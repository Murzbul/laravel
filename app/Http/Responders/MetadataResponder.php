<?php

namespace App\Http\Responders;

use Flugg\Responder\Http\Responses\ErrorResponseBuilder;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;

class MetadataResponder extends Responder
{
    public function __construct(SuccessResponseBuilder $successResponseBuilder, ErrorResponseBuilder $errorResponseBuilder)
    {
        parent::__construct($successResponseBuilder, $errorResponseBuilder);
    }

    public function success($data = null, $transformer = null, string $resourceKey = null): SuccessResponseBuilder
    {
        return parent::success($data, $transformer, $resourceKey)->meta(['metadata' => '']);
    }
}
