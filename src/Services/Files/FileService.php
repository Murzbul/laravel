<?php

namespace Digichange\Services\Files;

use Digichange\Payloads\Files\FilesPayload;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidFactory;

class FileService
{
    /** @var UuidFactory */
    private $uuidFactory;
    /** @var Filesystem */
    private $filesystem;

    public function __construct(Filesystem $filesystem, UuidFactory $uuidFactory)
    {
        $this->uuidFactory = $uuidFactory;
        $this->filesystem = $filesystem;
    }

    public function upload(FilesPayload $payload): string
    {
        $hash = md5($payload->file()->getClientOriginalName() . Str::random());
        $hash = $hash . '.' . $payload->file()->clientExtension();

        Storage::disk()->put($hash, file_get_contents($payload->file()->getRealPath()));

        return $hash;
    }

    public function recover(string $id): ?string
    {
        $file = Storage::disk()->get($id);

        return $file;
    }
}
