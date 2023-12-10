<?php

namespace App\Http\Controllers;

use App\Services\TokenService\TokenService;
use Illuminate\Http\Request;

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
