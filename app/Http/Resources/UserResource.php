<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'phone' => $this->resource->phone,
            'position' => $this->resource->position->name,
            'position_id' => $this->resource->position_id,
            'registration_timestamp' => Carbon::parse($this->resource->created_at)->timestamp,
            'photo' => Storage::url(User::PHOTOS_FOLDER.'/'.$this->resource->photo),
        ];
    }
}
