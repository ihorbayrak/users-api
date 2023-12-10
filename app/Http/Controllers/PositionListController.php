<?php

namespace App\Http\Controllers;

use App\Http\Resources\PositionResource;
use App\Models\Position;
use App\Services\TokenService\TokenService;
use Illuminate\Http\Request;

class PositionListController extends ResponseController
{
    public function __construct(private TokenService $tokenService)
    {
    }

    public function __invoke(Request $request)
    {
        $this->tokenService->validateToken($request->header('Token'));

        return $this->responseOk([
            'positions' => PositionResource::collection(Position::all())
        ]);
    }
}
