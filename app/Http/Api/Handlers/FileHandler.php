<?php

namespace App\Http\Api\Handlers;

use App\Http\Api\Requests\Files\FileUploadRequest;
use App\Http\Responders\MetadataResponder as Responder;
use Digichange\Services\Files\FileService;

class FileHandler extends Handler
{
    /** @var Responder */
    private $responder;
    /** @var FileService */
    private $service;

    public function __construct(Responder $responder, FileService $service)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function upload(FileUploadRequest $request)
    {
        $request->validate();

        $fileName = $this->service->upload($request);

        return $this->responder->success(['fileName' => $fileName])->respond();
    }
}
