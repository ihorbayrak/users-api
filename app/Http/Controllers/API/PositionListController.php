<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PositionResource;
use App\Models\Position;

class PositionListController extends ResponseController
{
    public function __invoke()
    {
        return $this->responseOk([
            'positions' => PositionResource::collection(Position::all())
        ]);
    }
}
