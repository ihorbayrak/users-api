<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionListController extends ResponseController
{
    public function __invoke()
    {
        return $this->responseOk([
            'positions' => PositionResource::collection(Position::all())
        ]);
    }
}
