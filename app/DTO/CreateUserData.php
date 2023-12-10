<?php

namespace App\DTO;

use Illuminate\Http\UploadedFile;

class CreateUserData
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly int $position_id,
        public readonly UploadedFile $photo
    ) {
    }
}
