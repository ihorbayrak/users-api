<?php

namespace App\Services\PhotoService;

use Illuminate\Http\UploadedFile;

interface PhotoServiceInterface
{
    public function optimize(UploadedFile $file);

    public function resize(UploadedFile $file, int $width, int $height);

    public function convert(UploadedFile $file, string $to);
}
