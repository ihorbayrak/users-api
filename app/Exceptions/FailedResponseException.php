<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\Responsable;

class FailedResponseException extends Exception implements Responsable
{
    public function __construct(protected ?array $fails = null)
    {
        parent::__construct();
    }

    public function toResponse($request)
    {
        $response = [
            'success' => false,
            'message' => $this->message
        ];

        if (!empty($this->fails)) {
            $response = array_merge($response, $this->fails);
        }

        return response()->json($response, $this->code);
    }
}
