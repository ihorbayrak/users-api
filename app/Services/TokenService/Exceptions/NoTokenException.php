<?php

namespace App\Services\TokenService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class NoTokenException extends FailedResponseException
{
    protected $message = "Token is invalid";
    protected $code = Response::HTTP_UNAUTHORIZED;
}
