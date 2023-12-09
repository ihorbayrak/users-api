<?php

namespace App\Http\Controllers;

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
