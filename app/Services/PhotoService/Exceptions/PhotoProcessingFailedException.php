<?php

namespace App\Services\PhotoService\Exceptions;

use App\Exceptions\FailedResponseException;
use Symfony\Component\HttpFoundation\Response;

class PhotoProcessingFailedException extends FailedResponseException
{
    protected $message = "Photo processing failed";
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
}
