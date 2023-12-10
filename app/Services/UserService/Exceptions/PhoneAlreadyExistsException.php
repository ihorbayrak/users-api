<?php

namespace App\Services\UserService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class PhoneAlreadyExistsException extends FailedResponseException
{
    protected $message = "User with this phone already exists";
    protected $code = Response::HTTP_CONFLICT;
}
