<?php

namespace App\Services\UserService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class UserNotFoundException extends FailedResponseException
{
    protected $message = "The user with the requested identifier does not exist";
    protected $code = Response::HTTP_NOT_FOUND;
}
