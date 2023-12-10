<?php

namespace App\Services\UserService\Actions;

use App\Enum\FileExtension;
use App\Models\User;
use App\Services\PhotoService\PhotoServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorePhotoAction
{
    public function __construct(private PhotoServiceInterface $photoService)
    {
    }

    public function handle(UploadedFile $photo, ?string $folder = null)
    {
        $this->photoService->optimize($photo);
        $this->photoService->resize($photo, User::PHOTO_WIDTH, User::PHOTO_HEIGHT);
        $extension = $this->photoService->convert($photo, FileExtension::JPG->value);

        $fileName = uniqid().'.'.$extension;

        $path = $folder ? $folder.'/'.$fileName : $fileName;

        Storage::put($path, file_get_contents($photo));

        return $fileName;
    }
}
