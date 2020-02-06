<?php

namespace App\Http\Api\Requests\Files;

use Digichange\Payloads\Files\FilesPayload;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class FileUploadRequest implements FilesPayload
{
    public const FILE = 'file';

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function file(): UploadedFile
    {
        return $this->request->file(static::FILE);
    }

    public function validate()
    {
        $this->request->validate([
            self::FILE => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }
}
