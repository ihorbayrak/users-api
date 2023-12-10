<?php

namespace App\Http\Controllers\API;

use App\Services\TokenService\TokenService;

class TokenController extends ResponseController
{
    public function __construct(private TokenService $tokenService)
    {
    }

    public function __invoke()
    {
        return $this->responseCreated([
            'token' => $this->tokenService->createToken()
        ]);
    }
}
