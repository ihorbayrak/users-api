<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersCollection extends ResourceCollection
{
    public $collects = UserResource::class;

    public function toArray(Request $request): array
    {
        $paginator = $this->resource->toArray();

        return [
            'success' => true,
            'page' => $paginator['current_page'],
            'total_pages' => $paginator['last_page'],
            'total_users' => $paginator['total'],
            'count' => $paginator['per_page'],
            'links' => [
                "next_url" => isset($paginator['next_page_url']) ? $paginator['next_page_url']."&count={$paginator['per_page']}" : null,
                "prev_url" => isset($paginator['prev_page_url']) ? $paginator['prev_page_url']."&count={$paginator['per_page']}" : null
            ],
            'users' => $this->collection
        ];
    }
}
