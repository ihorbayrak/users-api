<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ResponseController extends Controller
{
    public function responseOk($data)
    {
        return response()->json([
            'success' => true,
            ...$data
        ], Response::HTTP_OK);
    }

    public function responseCreated(array $data)
    {
        return response()->json([
            'success' => true,
            ...$data
        ], Response::HTTP_CREATED);
    }
}
