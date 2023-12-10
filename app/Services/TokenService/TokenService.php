<?php

namespace App\Services\TokenService;

use App\Models\Token;
use App\Services\TokenService\Exceptions\NoTokenException;
use App\Services\TokenService\Exceptions\TokenExpiredException;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TokenService
{
    public function createToken()
    {
        $token = Token::create([
            'token' => Str::random(64),
            'expired_at' => Carbon::now()->addSeconds(Token::SECONDS_TO_EXPIRE)
        ]);

        return $token->token;
    }

    public function validateToken($userToken)
    {
        $token = Token::where('token', $userToken)->first();

        if (!$token) {
            throw new NoTokenException();
        }

        if (Carbon::now() > $token->expired_at) {
            $token->delete();

            throw new TokenExpiredException();
        }

        $token->delete();
    }
}
