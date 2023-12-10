<?php

namespace App\Services\PhotoService;

use App\Services\PhotoService\Exceptions\PhotoProcessingFailedException;
use Illuminate\Http\UploadedFile;
use Tinify\Tinify;

class TinifyService implements PhotoServiceInterface
{
    public function __construct()
    {
        Tinify::setKey(config('tinify.key'));
    }

    /*
     In documentation, it says that optimization occurs when resizing image, but I decided to make separate method
     */
    public function optimize(UploadedFile $file)
    {
        try {
            $source = \Tinify\fromFile($file);

            $source->toFile($file);
        } catch (\Exception $exception) {
            throw new PhotoProcessingFailedException();
        }
    }

    public function resize(UploadedFile $file, int $width, int $height)
    {
        try {
            $source = \Tinify\fromFile($file);
            $resized = $source->resize([
                "method" => "fit",
                "width" => $width,
                "height" => $height
            ]);
            $resized->toFile($file);
        } catch (\Exception $exception) {
            throw new PhotoProcessingFailedException();
        }
    }

    public function convert(UploadedFile $file, string $to)
    {
        try {
            $source = \Tinify\fromFile($file);
            $converted = $source->convert(["type" => ["image/{$to}"]]);
            $converted->toFile($file);

            return $converted->result()->extension();
        } catch (\Exception $exception) {
            throw new PhotoProcessingFailedException();
        }
    }
}
