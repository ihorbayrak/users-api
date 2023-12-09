<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class FailedValidationException extends Exception implements Responsable
{
    public function __construct(protected array $fails)
    {
        parent::__construct();
    }

    public function toResponse($request)
    {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'fails' => $this->fails
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
