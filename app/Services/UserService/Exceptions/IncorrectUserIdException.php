<?php

namespace App\Services\UserService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class IncorrectUserIdException extends FailedResponseException
{
    protected $message = "Validation failed";
    protected $code = Response::HTTP_BAD_REQUEST;
}
