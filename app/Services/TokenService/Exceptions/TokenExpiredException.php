<?php

namespace App\Services\TokenService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class TokenExpiredException extends FailedResponseException
{
    protected $message = "The token expired";
    protected $code = Response::HTTP_UNAUTHORIZED;
}
