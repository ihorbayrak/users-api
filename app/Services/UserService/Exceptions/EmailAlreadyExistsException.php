<?php

namespace App\Services\UserService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class EmailAlreadyExistsException extends FailedResponseException
{
    protected $message = "User with this email already exists";
    protected $code = Response::HTTP_CONFLICT;
}
